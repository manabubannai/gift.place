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
            return redirect(route('user.dashboard'))->with([
                'toast' => [
                    'status'  => 'error',
                    'message' => '投稿できるのは一日一回です',
                ],
            ]);
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
     * @param string $uuId
     *
     * @return
     */
    public function userFindMessageByUuId(string $uuId): \App\Models\Message
    {
        $message = $this->messageRepository->findByUuId($uuId);

        if (empty($message)) {
            abort(404);
        }

        return $message;
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
