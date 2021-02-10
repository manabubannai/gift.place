<?php
namespace App\Http\Controllers\Web\User\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialAccount\SocialAccountServiceInterface;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAccountController extends Controller
{
    public function __construct(
        SocialAccountServiceInterface $socialAccountService
    ) {
        $this->socialAccountService = $socialAccountService;
    }

    /**
     * Redirect the user to the Provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            \Log::info($e);

            return redirect(route('home'));
        }

        $socialAccount = $this->socialAccountService->findAlreadyRegisteredSocialAccount($providerUser);

        // logger($socialAccount);

        if ($socialAccount) {
            $authUser = $this->socialAccountService->findAlreadyRegisteredUser($socialAccount->user_id);
        }

        if (!$socialAccount && !is_null($providerUser->email)) {
            $authUser = $this->socialAccountService->create($providerUser, $provider);
        }

        // $providerUser->provideruserをsessionに保存し
        // emailを入力するformに飛ばす email保存先でregister usecaseを呼び出す
        if (is_null($providerUser->email)) {
            session([
                'callback_provider_user'  => $providerUser,
                'callback_provider'       => $provider,
            ]);

            return redirect(route('user.auth.get.email'));
        }

        Auth::login($authUser);

        return $this->sendLoginResponse();
    }

    public function getEmail()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }

        $provider     = session('callback_provider');
        $providerUser = session('callback_provider_user');

        if (empty($provider) || empty($providerUser)) {
            return redirect(route('home'));
        }

        return view('pages.user.auth.email');
    }

    public function storeEmail(Request $request)
    {
        $providerName = session('callback_provider');
        $providerUser = session('callback_provider_user');

        $providerUser->email = $request->input('email');
        $authUser            = $this->socialAccountService->create($providerUser, $providerName);

        Auth::login($authUser);

        return $this->sendLoginResponse();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/')->with([
            'toast' => [
                'status'  => 'success',
                'message' => 'ログアウトしました',
            ],
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     */
    protected function sendLoginResponse()
    {
        return redirect(route('user.dashboard'))->with([
            'toast' => [
                'status'  => 'success',
                'message' => 'ログインしました',
            ],
        ]);
    }
}
