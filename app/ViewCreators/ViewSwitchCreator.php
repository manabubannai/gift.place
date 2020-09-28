<?php
namespace App\Http\ViewCreators;

use Illuminate\Support\Facades\View as V;
use Illuminate\View\View;
use Illuminate\View\ViewName;
use Jenssegers\Agent\Agent;

/**
 * スマホのビューに自動で切り替える.
 */
class ViewSwitchCreator
{
    /**
     * ビュー差し替え対象外とするフォルダ
     *
     * @var array
     */
    private $excluded_folder = ['layouts'];

    /**
     * ビュー名の接尾語.
     *
     * @var string
     */
    private $view_name_suffix = '_sp';

    /**
     * 新しいプロフィールコンポーザの生成.
     */
    public function __construct()
    {
    }

    /**
     * データをビューと結合.
     *
     * @param View $view
     *
     * @return void
     */
    public function create(View $view)
    {
        $agent = new Agent();

        // スマホではない場合はスキップ
        if ($agent->isMobile() !== true) {
            return;
        }

        // スマホ向けのビューの場合はスキップ
        $name = $view->getName();
        if ($name && preg_match('|'.$this->view_name_suffix.'$|', $name) !== 0) {
            return;
        }

        // 除外フォルダの場合はスキップ
        list($dir) = explode('.', $name);
        if (in_array($dir, $this->excluded_folder)) {
            return;
        }

        // ビューを変更する
        $name = $name.$this->view_name_suffix;

        // ビューの存在チェック
        // ※ レスポンシブ対応ページも作れるように500エラーにはしない
        if (v::exists($name)) {
            $finder = v::getFinder();
            $view->setPath(
                $finder->find(
                    ViewName::normalize($name)
                )
            );
        }
    }
}
