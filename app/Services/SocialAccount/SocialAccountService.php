<?php
namespace App\Services\SocialAccount;

use App\Models\SocialAccount;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService implements SocialAccountServiceInterface
{
    public function getOrCreate(ProviderUser $providerUser, string $provider)
    {
        $account = SocialAccount::where('provider', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            session([
                'callback_provider_user' => $providerUser,
                'callback_provider'      => $provider,
            ]);

            return false;
        }
    }
}
