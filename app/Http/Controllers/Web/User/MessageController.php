<?php
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Services\Message\MessageServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Web\User\Message\StoreRequest;

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

    public function show(int $id)
    {
    }

    public function create()
    {
        return view('pages.user.messages.create');
    }

    // FIXME vvalidation
    public function store(StoreRequest $request)
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