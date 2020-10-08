<?php
namespace App\Policies\Web\User;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function edit(User $currentUser, User $targetUser)
    {
        return $currentUser->id === $targetUser->id;
    }
}
