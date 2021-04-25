<?php
namespace App\Services\Message;

use App\Models\Message;
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
     * @return Message
     */
    public function userStoreMessage(int $userId, array $input): Message
    {
        if (!isset($input['uuid'])) {
            $uuid      = \Illuminate\Support\Str::uuid();
            $shortUuid = new ShortUuid();
            \Arr::set($input, 'uuid', $shortUuid->encode($uuid));
        }

        if (!isset($input['user_id'])) {
            \Arr::set($input, 'user_id', $userId);
        }

        $message = $this->messageRepository->create($input);

        return $message;
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

        $message = $message->load('user');

        return $message;
    }

    /**
     * @param array $params
     *
     * @return
     */
    public function paginateOrderByDesc($params = [])
    {
        $messages = $this->messageRepository->getBlankModel();

        if (isset($params['user_id'])) {
            $messages = $messages->where('user_id', $params['user_id']);
        }

        $messages = $messages->orderBy('id', 'desc')
                    ->with('user')
                    ->paginate(5);

        return $messages;
    }
}
