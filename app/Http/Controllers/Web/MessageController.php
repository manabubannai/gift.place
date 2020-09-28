<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Message\MessageServiceInterface;
use Illuminate\Http\Request;

class MessageController extends Controller
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

    public function show()
    {
    }

    public function create()
    {
    }

    // FIXME vvalidation
    public function store(Request $request)
    {
        $this->messageService->userStoreMessage(\Auth::user()->id, $request->all());

        return redirect('/dashboard')->with([
            'toast' => [
                'status'  => 'success',
                'message' => '投稿しました',
            ],
        ]);
    }
}
