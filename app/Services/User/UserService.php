<?php
namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository            = $userRepository;
    }

    /**
     * usr退会処理.
     *
     * subscriptionをキャンセル
     *
     * @param \App\Models\User $authUser
     *
     * @return
     */
    public function userWithdrawal(\App\Models\User $authUser)
    {
        $authUser->subscription('default')->cancel();
    }
}
