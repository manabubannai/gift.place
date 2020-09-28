<?php
namespace App\Repositories\Message;

use App\Models\Message;
use App\Repositories\Base\BaseRepository;
use Carbon\Carbon;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getBlankModel()
    {
        return new Message();
    }

    /**
     * 投稿は一日一回に制限している
     * DBに一日前に投稿がないか確認する.
     *
     * @param int $userId
     *
     * @return bool
     */
    public function isUserAlreadyStoreByOneday(int $userId): bool
    {
        $today = Carbon::today('Asia/Tokyo');
        $today->timezone('UTC');

        $tomorrow = Carbon::tomorrow('Asia/Tokyo');
        $tomorrow->timezone('UTC');

        return $this->message
          ->where('user_id', $userId)
          ->whereBetween('created_at', [$today->toDateTimeString(), $tomorrow->toDateTimeString()])
          ->exists();
    }
}
