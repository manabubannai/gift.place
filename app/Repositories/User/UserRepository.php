<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Base\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getBlankModel()
    {
        return new User();
    }

    /**
     * @param string $slug
     *
     * @return \App\Models\Message
     */
    public function findBySlug(string $slug): \App\Models\User
    {
        return $this->user->where('slug', $slug)->first();
    }
}
