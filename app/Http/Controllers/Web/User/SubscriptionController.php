<?php
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Services\Payment\PaymentServiceInterface;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        PaymentServiceInterface $paymentService
    ) {
        $this->paymentService = $paymentService;
    }

    public function create()
    {
        if (\Auth::user()->subscribed('default')) {
            return redirect(route('user.dashboard'))->with([
                'toast' => [
                    'status'  => 'error',
                    'message' => '支払い済みです',
                ],
            ]);
        }

        return view('pages.user.subscription.create', [
            'intent'        => \Auth::user()->createSetupIntent(),
            'paymentMethod' => !is_null(\Auth::user()->defaultPaymentMethod()) ? \Auth::user()->defaultPaymentMethod() : null,
        ]);
    }

    public function store(Request $request)
    {
        try {
            // stripe Customer の作成（保存）
            // $stripeCustomer = \Auth::user()->createOrGetStripeCustomer();

            // $paymentMethod = $this->paymentService->updateOrCreateUserPaymentMethod(
            //     \Auth::user(),
            //     $request->input('payment_method'),
            //     $stripeCustomer->id
            // );

            // $this->paymentService->userCreateNewSubscription(\Auth::user(), $paymentMethod->id);

            return redirect(route('user.dashboard'))->with([
                'toast' => [
                    'status'  => 'success',
                    'message' => '入村手続きが完了しました',
                ],
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function cardChangeForm()
    {
        return view('pages.user.subscription.card-change', [
            'paymentMethod' => \Auth::user()->defaultPaymentMethod(),
            'intent'        => \Auth::user()->createSetupIntent(),
        ]);
    }

    public function cardChange(Request $request)
    {
        try {
            $stripeCustomer = \Auth::user()->createOrGetStripeCustomer();

            // if (\Auth::user()->hasDefaultPaymentMethod()) {
            //     \Auth::user()->deletePaymentMethods();
            //     \Auth::user()->updateDefaultPaymentMethod($request->input('payment_method'));
            // }

            // $paymentMethod = \Auth::user()->defaultPaymentMethod();

            // \Auth::user()->update([
            //     'card_brand'     => $paymentMethod->card->brand,
            //     'card_last_four' => $paymentMethod->card->last4,
            // ]);

            $paymentMethod = $this->paymentService->updateOrCreateUserPaymentMethod(
                \Auth::user(),
                $request->input('payment_method'),
                $stripeCustomer->id
            );

            return back()->with([
                'toast' => [
                    'status'  => 'success',
                    'message' => 'カードを変更しました',
                ],
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
