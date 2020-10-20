<?php
namespace App\Services\SocialAccount;

use Laravel\Socialite\Contracts\User as ProviderUser;

interface SocialAccountServiceInterface
{
    public function findAlreadyRegisteredSocialAccount(ProviderUser $providerUser): ?\App\Models\SocialAccount;

    public function create(
        ProviderUser $providerUser,
        string $providerName
    ): \App\Models\User;
}
