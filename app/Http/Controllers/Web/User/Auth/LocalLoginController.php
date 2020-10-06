<?php
namespace App\Http\Controllers\Web\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Image;
use App\Models\User;
use Auth;

class LocalLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/?status=success&message=ログインしました';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLocalLogin()
    {
        return view('auth.local-login');
    }

    public function postLocalRegister(Request $request)
    {
        \DB::beginTransaction();
        try {

            $user = User::create([
                'name'             => $request->name,
                'email'            => $request->email,
            ]);

            \DB::commit();
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();
            return redirect('/local/login');
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}
