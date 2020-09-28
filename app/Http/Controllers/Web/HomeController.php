<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        // \SeoHelper::setIndexSeo();
        return view('pages.index');
    }

    public function dashboard()
    {
        // \SeoHelper::setIndexSeo();
        return view('pages.dashboard');
    }
}
