<?php
namespace App\Services\Payment;

use App\Repositories\User\UserRepositoryInterface;
use Laravel\Cashier\Exceptions\IncompletePayment;

class PaymentService implements PaymentServiceInterface
{
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * userがサブスクリプションを作成する.
     *
     * @param \App\Models\User $authUser
     * @param string           $paymentMethodId
     *
     * @return void
     */
    public function userCreateNewSubscription(
        \App\Models\User $authUser,
        string $paymentMethodId
    ) {
        try {
            $authUser->newSubscription('default', config('services.stripe.plan'))
                ->create($paymentMethodId, [], [
                    'metadata' => ['user_id' => $authUser->id],
                ]);
        } catch (IncompletePayment $exception) {
            // dd($exception);
            \Log::error($exception);

            return redirect()->route('user.subscriptions.create')->with([
                'toast' => [
                    'status'  => 'error',
                    'message' => '決済に失敗しました',
                ],
            ]);
        }
    }

    /**
     * userがクレジットカードを登録する.
     *
     * @param \App\Models\User $authUser
     * @param string           $requestPaymentMethod
     * @param string           $stripeCustomerId
     *
     * @return object
     */
    public function updateOrCreateUserPaymentMethod(
        \App\Models\User $authUser,
        string $requestPaymentMethod,
        string $stripeCustomerId
    ): object {

        // 初回入会
        // クレジットカードを新たに登録
        if (!$authUser->hasDefaultPaymentMethod()) {
            $paymentMethod = $this->createUserPaymentMethod($authUser, $requestPaymentMethod, $stripeCustomerId);

            return $paymentMethod;
        }

        $defaultPaymentMethod = $authUser->defaultPaymentMethod();

        // 再入会
        // 登録済クレジットカード
        if ($authUser->hasDefaultPaymentMethod() && $defaultPaymentMethod->id === $requestPaymentMethod) {
            return $defaultPaymentMethod;
        }

        // 再入会
        // クレジットカードを新たに登録
        if ($authUser->hasDefaultPaymentMethod() && $defaultPaymentMethod->id !== $requestPaymentMethod) {
            $paymentMethod = $this->createUserPaymentMethod($authUser, $requestPaymentMethod, $stripeCustomerId);

            return $paymentMethod;
        }
    }

    private function createUserPaymentMethod(
        \App\Models\User $authUser,
        string $requestPaymentMethod,
        string $stripeCustomerId
    ): object {
        $authUser->updateDefaultPaymentMethod($requestPaymentMethod);

        $paymentMethod = $authUser->defaultPaymentMethod();

        $this->userRepository->update($authUser, [
            'stripe_id'      => $stripeCustomerId,
            'card_brand'     => $paymentMethod->card->brand,
            'card_last_four' => $paymentMethod->card->last4,
        ]);

        return $paymentMethod;
    }
}
