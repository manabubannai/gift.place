<?php
namespace App\Http\Middleware\User;

use Closure;

class Subscribed
{
    /**
     * stripe決済したかを判定する.
     * 有効期限が残っている場合、サブスクリプション再開.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->subscription('default')->onGracePeriod()) {
            $request->user()->subscription('default')->resume();
        }

        if ($request->user() && !$request->user()->subscribed('default')) {
            // このユーザーは支払っていない顧客
            return redirect(route('user.subscriptions.create'))->with([
                'toast' => [
                    'status'  => 'error',
                    'message' => '月額390円の登録が必要です',
                ],
            ]);
        }

        return $next($request);
    }
}
