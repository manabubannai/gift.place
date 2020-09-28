<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;

class UserComposer
{
    protected $user;

    public function __construct()
    {
        $currentUser = \Auth::user();

        if (is_null($currentUser)) {
            $this->user = $currentUser;
        } else {
            $this->user = $currentUser;
        }
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('currentUser', $this->user);
    }
}
