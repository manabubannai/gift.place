<?php
namespace App\Repositories\SocialAccount;

use App\Models\SocialAccount;
use App\Repositories\Base\BaseRepository;

class SocialAccountRepository extends BaseRepository implements SocialAccountRepositoryInterface
{
    private $socialAccount;

    public function __construct(SocialAccount $socialAccount)
    {
        $this->socialAccount = $socialAccount;
    }

    public function getBlankModel()
    {
        return new SocialAccount();
    }

    public function findByProviderId(string $providerId): ?\App\Models\SocialAccount
    {
        return $this->socialAccount->where('provider_id', $providerId)->first();
    }
}
