<?php
namespace App\Http\Controllers\Web;

use App\Jobs\PaymentHistoryJob;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
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
