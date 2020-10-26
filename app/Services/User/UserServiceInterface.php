<?php
namespace App\Services\User;

interface UserServiceInterface
{
    /**
     * usr退会処理.
     *
     * subscriptionをキャンセル
     *
     * @param \App\Models\User $authUser
     *
     * @return
     */
    public function userWithdrawal(\App\Models\User $authUser);
}
