<?php
namespace App\Mail\User;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NoticeUserPaymentMailable extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $errors;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $user,
        array $errors = []
    ) {
        $this->user    = $user;
        $this->errors  = $errors;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (count($this->errors) > 0) {
            $subject = 'プランのお支払いでエラーが発生しました';

            return $this->view('emails.user.notification-payment-failed', [
                'user'     => $this->user,
                'errors'   => $this->errors,
            ])->subject($subject);
        } else {
            $subject = 'プランのお支払いを受け付けました';

            return $this->view('emails.user.notification-payment', [
                'user'            => $this->user,
                'errors'          => $this->errors,
                'next_charge_at'  => Carbon::now()->addMonth(),
            ])->subject($subject);
        }
    }
}
