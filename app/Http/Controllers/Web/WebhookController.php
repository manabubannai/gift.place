<?php
namespace App\Http\Controllers\Web;

use App\Jobs\PaymentHistoryJob;
use Illuminate\Http\Request;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Stripe\Webhook;

class WebhookController extends CashierController
{
    // public function handleWebhook(Request $request)
    // {
    //     \Log::info('stripe webhook!');

    //     $payload    = @file_get_contents('php://input');
    //     $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? null;
    //     $exception  = null;

    //     if (!$payload || !$sig_header) {
    //         abort(500, 'No payload or signature.');
    //     }

    //     try {
    //         Webhook::constructEvent(
    //             $payload,
    //             $sig_header,
    //             config('services.stripe.webhook.secret')
    //         );
    //     } catch (\UnexpectedValueException $e) {
    //         // Invalid payload
    //         $exception = [
    //             'code'    => $e->getCode(),
    //             'message' => $e->getMessage(),
    //             'trace'   => $e->getTraceAsString(),
    //         ];
    //     } catch (\Stripe\Exception\SignatureVerificationException $e) {
    //         // Invalid signature
    //         $exception = [
    //             'code'    => $e->getCode(),
    //             'message' => $e->getMessage(),
    //             'trace'   => $e->getTraceAsString(),
    //         ];
    //     }

    //     PaymentHistoryJob::dispatch(
    //         json_encode(json_decode($payload)),
    //         ($exception ? json_encode($exception) : null)
    //     );

    //     return exit(200);
    // }

    /**
     * インボイス支払い成功時の処理.
     *
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleInvoicePaymentSucceeded($payload)
    {
        PaymentHistoryJob::dispatch($payload);

        return exit(200);
    }

    /**
     * インボイス支払い失敗時の処理.
     *
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleInvoicePaymentFailed($payload)
    {
        PaymentHistoryJob::dispatch($payload);

        return exit(200);
    }
}
