<?php
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\Message\StoreRequest;
use App\Models\MessageLike;
use App\Services\Message\MessageServiceInterface;

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

    public function show(string $uuId)
    {
        $message = $this->messageService->userFindMessageByUuId($uuId);

        // FIXME こういうコードはないわ
        $isLiked           = MessageLike::where('message_id', $message->id)
                                ->where('user_id', \Auth::user()->id)
                                ->exists();

        $defaultLike       = MessageLike::where('message_id', $message->id)
                                ->where('user_id', \Auth::user()->id)
                                ->first();

        return view('pages.user.messages.show', [
            'message'           => $message,
            'isLiked'           => $isLiked,
            'defaultLike'       => $defaultLike,
        ]);
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
