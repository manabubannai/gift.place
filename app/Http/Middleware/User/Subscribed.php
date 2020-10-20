<?php
namespace App\Http\Middleware\User;

use Closure;

class Subscribed
{
    /**
     * stripe決済したかを判定する.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && !$request->user()->subscribed('default')) {
            // このユーザーは支払っていない顧客
            return redirect(route('user.subscriptions.create'));
        }

        return $next($request);
    }
}
