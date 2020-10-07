<?php
namespace App\Http\Controllers\Web\User\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialAccount\SocialAccountServiceInterface;
use Auth;
use Illuminate\Http\Request;
// use Laravel\Socialite\Facades\Socialite;
use Socialite;

class SocialAccountController extends Controller
{
    public function __construct(
        SocialAccountServiceInterface $socialAccountService
    ) {
        $this->socialAccountService = $socialAccountService;
    }

    /**
     * Show the application registration form.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        return view('pages.user.auth.login');
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
    public function handleProviderCallback($provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->userFromTokenAndSecret(
                config('services.twitter.access_token'),
                config('services.twitter.access_token_secret'),
            );
        } catch (\Exception $e) {
            \Log::info($e);

            return redirect(route('user.auth.login'));
        }

        // $providerUser->provideruserをsessionに保存し
        // emailを入力するformに飛ばす email保存先でregister usecaseを呼び出す
        if (is_null($providerUser->email)) {
            session([
                'callback_provider_user' => $providerUser,
                'callback_provider'      => $provider,
            ]);

            return redirect(route('user.auth.get.email'));
        }

        $authUser = $this->socialAccountService->getOrCreate($providerUser, $provider);

        if (!$authUser) {
            return redirect(route('user.auth.get.email'));
        }

        Auth::login($authUser);

        return redirect(route('user.dashboard'));
    }

    public function getEmail()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        $provider     = session('callback_provider');
        $providerUser = session('callback_provider_user');

        if (empty($provider) || empty($providerUser)) {
            return redirect(route('user.auth.login'));
        }

        return view('pages.user.auth.email');
    }

    public function storeEmail(Request $request)
    {
        $providerName = session('callback_provider');
        $providerUser = session('callback_provider_user');

        $providerUser->email = $request->input('email');
        $authUser            = $this->socialAccountService->getOrCreate($providerUser, $providerName);

        Auth::login($authUser);

        return redirect(route('user.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
