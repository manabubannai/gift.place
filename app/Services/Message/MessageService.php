<?php
namespace App\Services\Message;

use App\Repositories\Message\MessageRepositoryInterface;
use PascalDeVink\ShortUuid\ShortUuid;

class MessageService implements MessageServiceInterface
{
    public function __construct(
        MessageRepositoryInterface $messageRepository
    ) {
        $this->messageRepository = $messageRepository;
    }

    /**
     * userがmessageを投稿する.
     *
     * @param int   $userId
     * @param array $input
     *
     * @return
     */
    public function userStoreMessage(int $userId, array $input)
    {
        // すでに投稿があるか
        if ($this->messageRepository->isUserAlreadyStoreByOneday($userId)) {
            // FIXME error messageの出し方や例外の扱い
            abort(400);
        }

        if (!isset($input['uuid'])) {
            $uuid      = \Illuminate\Support\Str::uuid();
            $shortUuid = new ShortUuid();
            \Arr::set($input, 'uuid', $shortUuid->encode($uuid));
        }

        if (!isset($input['user_id'])) {
            \Arr::set($input, 'user_id', $userId);
        }

        $message = $this->messageRepository->create($input);
    }

    /**
     * @return
     */
    public function paginateOrderByDesc()
    {
        // FIXME
        return $this->messageRepository
                    ->getBlankModel()
                    ->latest()
                    ->paginate();
    }
}
