<?php
namespace App\Services\SocialAccount;

use Laravel\Socialite\Contracts\User as ProviderUser;

interface SocialAccountServiceInterface
{
    public function getOrCreate(ProviderUser $providerUser, string $provider);
}
