<?php
namespace App\Services\SocialAccount;

use App\Repositories\SocialAccount\SocialAccountRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService implements SocialAccountServiceInterface
{
    public function __construct(
        UserRepositoryInterface $userRepository,
        SocialAccountRepositoryInterface $socialAccountRepository
    ) {
        $this->userRepository            = $userRepository;
        $this->socialAccountRepository   = $socialAccountRepository;
    }

    public function findAlreadyRegisteredSocialAccount(
        ProviderUser $providerUser
    ): ?\App\Models\SocialAccount {
        return $this->socialAccountRepository->findByProviderId($providerUser->id);
    }

    public function findAlreadyRegisteredUser(
        int $userId,
        ProviderUser $providerUser
    ): \App\Models\User {
        $user = $this->userRepository->find($userId);

        $user->fill([
            'name'      => $providerUser->name,
            'cover_url' => $providerUser->avatar,
            'api_token' => Str::random(60),
        ])->save();

        return $user;
    }

    public function create(
        ProviderUser $providerUser,
        string $providerName
    ): \App\Models\User {
        $user = \DB::transaction(function () use ($providerUser, $providerName) {
            $user = $this->userRepository->create([
                  'name'             => $providerUser->name,
                  'email'            => $providerUser->email,
                  'slug'             => $providerUser->nickname,
                  'cover_url'        => $providerUser->avatar,
                  'api_token'        => Str::random(60),
            ]);

            $socialAccount = $this->socialAccountRepository->create([
                'user_id'                => $user->id,
                'provider_id'            => $providerUser->id,
                'provider'               => $providerName,
                'provider_access_token'  => $providerUser->token,
            ]);

            return $user;
        });

        return $user;
    }
}
