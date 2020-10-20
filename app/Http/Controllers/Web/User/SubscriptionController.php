<?php
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Services\Message\MessageServiceInterface;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        MessageServiceInterface $messageService
    ) {
        $this->messageService = $messageService;
    }

    public function create()
    {
        return view('pages.user.subscription.create', [
            'intent' => \Auth::user()->createSetupIntent(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            // stripe Customer の作成（保存）
            $stripeCustomer = \Auth::user()->createOrGetStripeCustomer();

            if (!\Auth::user()->hasDefaultPaymentMethod()) {
                \Auth::user()->updateDefaultPaymentMethod($request->input('payment_method'));
            }

            $paymentMethod = \Auth::user()->defaultPaymentMethod();

            \Auth::user()->update([
                'stripe_id'      => $stripeCustomer->id,
                'card_brand'     => $paymentMethod->card->brand,
                'card_last_four' => $paymentMethod->card->last4,
            ]);

            \Auth::user()->newSubscription('default', config('services.stripe.plan'))->create($paymentMethod->id);

            return redirect(route('user.dashboard'));
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

            if (\Auth::user()->hasDefaultPaymentMethod()) {
                \Auth::user()->deletePaymentMethods();
                \Auth::user()->updateDefaultPaymentMethod($request->input('payment_method'));
            }

            $paymentMethod = \Auth::user()->defaultPaymentMethod();

            \Auth::user()->update([
                'card_brand'     => $paymentMethod->card->brand,
                'card_last_four' => $paymentMethod->card->last4,
            ]);

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
