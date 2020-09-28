<?php
namespace App\Services\Message;

use App\Repositories\Message\MessageRepositoryInterface;

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
        $input = $request->only($this->messageRepository->getBlankModel()->getFillable());

        // すでに投稿があるか
        if ($this->messageRepository->isUserAlreadyStoreByOneday($userId)) {
            // FIXME error messageの出し方や例外の扱い
            abort(400);
        }

        // FIXME short uuid
        if (!isset($input['uuid'])) {
            \Arr::set($input, 'uuid', \Illuminate\Support\Str::uuid());
        }

        $message = $this->messageRepository->create($input);
    }
}
