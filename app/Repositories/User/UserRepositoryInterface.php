<?php
namespace App\Repositories\User;

use App\Repositories\Base\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getBlankModel();

    /**
     * @param string $slug
     *
     * @return \App\Models\Message
     */
    public function findBySlug(string $slug): \App\Models\User;
}
