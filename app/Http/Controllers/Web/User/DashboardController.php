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
            dd($request->all());
            // stripe Customer の作成（保存）
            $stripeCustomer = \Auth::user()->createOrGetStripeCustomer();

            \Auth::user()->update([
                'stripe_id' => $stripeCustomer->id,
            ]);

            $paymentMethod = $method->id;   // 新しいカードのID

            dd(\Auth::user()->defaultPaymentMethod(), $stripeCustomer);

            // \Auth::user()->newSubscription('default', 'Stripeで作成されたプランID')->create($request->input('stripe_token'));

            return back();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
