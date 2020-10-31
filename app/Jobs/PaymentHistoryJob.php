<?php
namespace App\Jobs;

use App\Mail\User\NoticeUserPaymentMailable;
use App\Models\PaymentHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PaymentHistoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $payload;
    private $exception;

    public $tries   = 3;  // 試行回数
    public $timeout = 120;  //timeoutまでの秒数

    /**
     * Create a new job instance.
     */
    public function __construct($payload)
    {
        $this->payload   = $payload;
    }

    /**
     * タイムアウトになる時間を決定.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addSeconds(5);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return $this->handleStripe();
    }

    private function handleStripe()
    {
        $payload   = $this->payload;
        $object    = (isset($payload['data']['object'])) ? $payload['data']['object'] : null;
        $meta      = $object['metadata'] ?? [];
        $customer  = null;
        $account   = null;

        \Log::info('event:'.$payload['type']);

        $event     = $payload['type'] ?? 'unknown';
        $status    = PaymentHistory::STATUS_UNKNOWN;
        switch ($event) {
            case 'invoice.paid':
                $status = PaymentHistory::STATUS_SUCCEEDED;
                break;
            case 'invoice.payment_failed':
                $status = PaymentHistory::STATUS_FAILED;
                break;
            default:
                break;
        }

        if ($status !== PaymentHistory::STATUS_UNKNOWN) {
            logger($object);
            try {
                if (!$object) {
                    // ERROR
                    throw new \Exception('Stripe Webhook | NO OBJECT');
                }

                $userId  = $meta['user_id'] ?? null;
                $lines   = $object['lines']['data'] ?? [];
                foreach ($lines as $lineItem) {
                    $userId  = $lineItem['metadata']['user_id'] ?? null;
                }

                // History追加
                PaymentHistory::create([
                    'user_id'    => $userId,
                    'provider'   => 'stripe',
                    'event'      => $event,
                    'status'     => $status,
                    'type'       => PaymentHistory::TYPE_SUBSCRIPTION,
                    'amount'     => $object['amount_paid'] ?? 0,
                    'payload'    => $this->payload ?? '',
                    'exception'  => $this->exception ?? '',
                ]);

                if (!$userId) {
                    throw new \Exception('Stripe Webhook | NO User ID');
                }

                if (!$user = User::where('id', $userId)->withTrashed()->first()) {
                    throw new \Exception('No user found. ID='.$userId);
                }

                // userPlan紐付け解除 if failed
                if ($status === PaymentHistory::STATUS_FAILED) {
                    Log::notice('PaymentHistoryJob: '.'支払いエラー発生');

                    Log::channel('slack')->error('userID: '.$user->id.' 支払いエラー発生');

                    \MailHelper::send($user->email, new NoticeUserPaymentMailable(
                        $user,
                        [
                            sprintf('%s クレジットカード課金エラー', Carbon::now()->format('Y年m月d日')),
                        ]
                    ));
                } else {
                    Log::channel('slack')->error('userID: '.$user->id.' 支払い成功');
                    \MailHelper::send($user->email, new NoticeUserPaymentMailable(
                        $user,
                    ));
                }
            } catch (\Exception $e) {
                Log::error('PaymentHistoryJob: '.$e->getMessage());
            }
        }

        return;
    }
}
