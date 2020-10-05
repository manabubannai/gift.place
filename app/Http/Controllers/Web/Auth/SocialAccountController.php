<?php

namespace App\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Services\SocialAccountService;

class SocialAccountController extends Controller
{
    /**
     * Show the application registration form.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        return view('pages.auth.login');
    }

    /**
     * Redirect the user to the Provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    public function handleProviderCallback(SocialAccountService $socialAccountService, $provider)
    {

        try {
            $user = \Socialite::with($provider)->user();
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect('/login');
        }

        $authUser = $socialAccountService->getOrCreate($user, $provider);

        if(!$authUser) {
            return redirect('/email');
        }

        Auth::login($authUser);

        return redirect()->to('/');
    }

    public function getEmail()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        $provider     = session('callback_provider');
        $providerUser = session('callback_provider_user');

        if(empty($provider) || empty($providerUser)) {
            return redirect('/login');
        }

        return view('auth.email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

}
