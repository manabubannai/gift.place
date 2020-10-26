<?php
namespace App\Http\Controllers\Web\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('pages.user.auth.local-login');
    }

    public function postLocalRegister(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (!User::where('email', $request->email)->exists()) {
                $user = User::create([
                    'name'             => $request->name,
                    'slug'             => $request->name,
                    'email'            => $request->email,
                    'api_token'        => Str::random(60),
                ]);
            }

            if (User::where('email', $request->email)->exists()) {
                $user = User::where('email', $request->email)->first();
            }

            \DB::commit();
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();

            return redirect('/auth/local/login')->with([
                'toast' => [
                    'status'  => 'error',
                    'message' => '登録に失敗しました',
                ],
            ]);
        }

        Auth::login($user);

        return redirect(route('user.dashboard'))->with([
            'toast' => [
                'status'  => 'success',
                'message' => 'ログインしました',
            ],
        ]);
    }
}
