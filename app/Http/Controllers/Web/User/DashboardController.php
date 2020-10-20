<?php
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Services\Message\MessageServiceInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

    public function dashboard()
    {
        $messages = $this->messageService->paginateOrderByDesc();
        // \SeoHelper::setIndexSeo();
        return view('pages.user.dashboard', [
            'messages' => $messages,
        ]);
    }

    public function card()
    {
        return view('pages.user.card', [
            'intent' => \Auth::user()->createSetupIntent(),
        ]);
    }

    public function cardStore(Request $request)
    {
        try {
            // stripe Customer の作成（保存）
            $stripeCustomer = \Auth::user()->createOrGetStripeCustomer();

            if (!\Auth::user()->hasDefaultPaymentMethod()) {
                // \Auth::user()->addPaymentMethod($request->input('payment_method'));
                \Auth::user()->updateDefaultPaymentMethod($request->input('payment_method'));
            }

            $paymentMethod = \Auth::user()->defaultPaymentMethod();

            \Auth::user()->update([
                'stripe_id'      => $stripeCustomer->id,
                'card_brand'     => $paymentMethod->card->brand,
                'card_last_four' => $paymentMethod->card->last4,
            ]);

            // \Auth::user()->newSubscription('default', 'Stripeで作成されたプランID')->create($request->input('stripe_token'));

            return back();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
