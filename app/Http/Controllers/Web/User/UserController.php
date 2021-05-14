<?php
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserServiceInterface $userService,
        UserRepositoryInterface $userRepository
    ) {
        $this->userService    = $userService;
        $this->userRepository = $userRepository;
    }

    public function show(string $slug, Request $request)
    {
        $user = $this->userRepository->findBySlug($slug);

        return view('pages.user.users.show', [
            'user' => $user,
        ]);
    }

    public function edit(string $slug, Request $request)
    {
        $user = \Auth::user();

        $this->authorize('user-user-can-edit', $user);

        return view('pages.user.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(string $slug, Request $request)
    {
        $user = \Auth::user();

        $this->authorize('user-user-can-edit', $user);

        $input = $request->only($this->userRepository->getBlankModel()->getFillable());
        $user  = $this->userRepository->update($user, $input);

        return redirect(route('user.users.show', $slug))->with([
            'toast' => [
                'status'  => 'success',
                'message' => '編集しました',
            ],
        ]);
    }

    public function destroyForm(string $slug, Request $request)
    {
        $user = \Auth::user();

        // Retrieve the timestamp from Stripe
        $timestamp = $user->asStripeCustomer()['subscriptions']->data[0]['current_period_end'];

        // Cast to Carbon instance and return
        $nextPaymentday = Carbon::createFromTimeStamp($timestamp)->toFormattedDateString();

        $this->authorize('user-user-can-edit', $user);

        return view('pages.user.users.destroy', [
            'user'           => $user,
            'nextPaymentday' => $nextPaymentday,
        ]);
    }

    /**
     * 退会処理.
     *
     * @return
     */
    public function destroy(string $slug, Request $request)
    {
        $user = $this->userRepository->findBySlug($slug);

        $this->authorize('user-user-can-edit', $user);

        $this->userService->userWithdrawal(\Auth::user());

        \Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'))->with([
            'toast' => [
                'status'  => 'success',
                'message' => '退会しました。。 また来てね!',
            ],
        ]);
    }
}
