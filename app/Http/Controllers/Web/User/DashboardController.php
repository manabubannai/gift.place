<?php
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function dashboard()
    {
        // \SeoHelper::setIndexSeo();
        return view('pages.user.dashboard');
    }
}
