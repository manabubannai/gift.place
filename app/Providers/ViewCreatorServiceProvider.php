<?php
namespace App\Providers;

use App\Http\ViewCreators as V;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewCreatorServiceProvider extends ServiceProvider
{
    /**
     * 全アプリケーションサービスの初期起動処理.
     *
     * @return void
     */
    public function boot()
    {
        View::creator('*', V\ViewSwitchCreator::class);
    }

    /**
     * コンテナ結合の登録.
     *
     * @return void
     */
    public function register()
    {
    }
}
