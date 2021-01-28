<?php
namespace App\Services\Payment;

interface PaymentServiceInterface
{
    /**
     * userがクレジットカードを登録する.
     *
     * @param \App\Models\User $authUser
     * @param string           $requestPaymentMethod
     * @param string           $stripeCustomerId
     *
     * @return void
     */
    public function updateOrCreateUserPaymentMethod(
        \App\Models\User $authUser,
        string $requestPaymentMethod,
        string $stripeCustomerId
    ): object;
}
