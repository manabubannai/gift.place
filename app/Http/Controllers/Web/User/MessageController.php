<?php
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\Message\StoreRequest;
use App\Models\MessageLike;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Services\Message\MessageServiceInterface;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        MessageRepositoryInterface $messageRepository,
        MessageServiceInterface $messageService
    ) {
        $this->messageService    = $messageService;
        $this->messageRepository = $messageRepository;
    }

    public function show(string $uuId)
    {
        $message = $this->messageService->userFindMessageByUuId($uuId);

        // 自分の投稿の投稿詳細pageにアクセスした時のみ、いいねをした人が見える
        // FIXME
        $likedUsers = [];
        if (\Auth::user()->id === $message->id) {
            $messageId = $message->id;

            $likedUsers = \App\Models\User::whereIn('users.id', function ($query) use ($messageId) {
                $query->from('message_likes')
                    ->select('message_likes.user_id')
                    ->where('message_likes.message_id', $messageId);
            })->get();
        }

        // FIXME こういうコードはないわ
        $isLiked           = MessageLike::where('message_id', $message->id)
                                ->where('user_id', \Auth::user()->id)
                                ->exists();

        $defaultLike       = MessageLike::where('message_id', $message->id)
                                ->where('user_id', \Auth::user()->id)
                                ->first();

        \SeoHelper::setMessageShowSeo($message);

        return view('pages.user.messages.show', [
            'message'           => $message,
            'isLiked'           => $isLiked,
            'defaultLike'       => $defaultLike,
            'likedUsers'        => $likedUsers,
        ]);
    }

    public function create()
    {
        // すでに投稿があるか
        if ($this->messageRepository->isUserAlreadyStoreByOneday(\Auth::user()->id)) {
            return redirect()->route('user.dashboard')->with([
                'toast' => [
                    'status'  => 'error',
                    'message' => '投稿できるのは一日一回です',
                ],
            ]);
        }

        return view('pages.user.messages.create');
    }

    // FIXME vvalidation
    public function store(StoreRequest $request)
    {
        $message = $this->messageService->userStoreMessage(
            \Auth::user()->id,
            $request->all()
        );

        return redirect(route('user.messages.show', $message->uuid))->with([
            'toast' => [
                'status'  => 'success',
                'message' => '投稿しました',
            ],
        ]);
    }
}
