<?php
namespace App\Repositories\SocialAccount;

use App\Repositories\Base\BaseRepositoryInterface;

interface SocialAccountRepositoryInterface extends BaseRepositoryInterface
{
    public function getBlankModel();

    public function findByProviderId(string $providerId): ?\App\Models\SocialAccount;

    /**
     * @param string $providerId
     *
     * @return bool
     */
    public function existsByProviderId(string $providerId): bool;
}
