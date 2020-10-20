<?php
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Services\Message\MessageServiceInterface;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        MessageServiceInterface $messageService
    ) {
        $this->messageService = $messageService;
    }

    public function dashboard()
    {
        $messages = $this->messageService->paginateOrderByDesc();
        // \SeoHelper::setIndexSeo();
        return view('pages.user.dashboard', [
            'messages' => $messages,
        ]);
    }
}
