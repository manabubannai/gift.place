<?php
namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class RequestLog
{
    protected $start;
    protected $end;

    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $this->writeLog($request, $response);
    }

    /**
     * リクエストの内容をログへ書き出す.
     *
     * @param Request $request
     * @param $response Laravel側で処理されるterminateの$responseの型が縛られていない為、typehintを記述していない.
     */
    private function writeLog(Request $request, $response): void
    {
        $logContent = $this->logContent($request, $response);

        // 集計、分析に用いやすい様にjson形式へ変換する
        $logContentJson = json_encode($logContent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        \Log::info($logContentJson);
    }

    /**
     * ログへ出力する内容.パスワード等のセキュアな情報が出力されない様に注意.
     *
     * @param Request $request
     *
     * @return array
     */
    private function logContent(Request $request, $response): array
    {
        $now = new Carbon();

        // Response Contentを出力すると情報が多すぎるため一旦出力していない
        $requestInfo = [
            'type'      => 'response',
            'method'    => $request->method(),
            'path'      => $request->path(),
            'header'    => $request->header(),
            'ip'        => $request->ip(),
            'status'    => $response->status(),
            'timestamp' => $now->toIso8601ZuluString(),
        ];

        $requestInputs = $request->all();
        $user          = $request->user();

        // 分析しやすい様にuserのidのみlogへ追加する
        if (!is_null($user)) {
            $requestInfo['user_id'] = $user->id;
        }

        // GET以外の場合、ユーザーのパスワード等セキュアな情報が送信されている場合も存在するためリクエスト内容のログは残さない。
        if ($request->isMethod('GET')) {
            $requestInfo['request'] = $requestInputs;
        }

        return $requestInfo;
    }
}
