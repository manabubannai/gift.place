<?php
namespace App\Services\SocialAccount;

use App\Repositories\SocialAccount\SocialAccountRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
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

    public function getOrCreate(ProviderUser $providerUser, string $providerName): \App\Models\User
    {
        //privider_idですでに登録済みかチェック
        $socialAccount = $this->socialAccountRepository->findByProviderId($providerUser->id);

        if (!$socialAccount) {
            $user = \DB::transaction(function () use ($providerUser, $providerName) {
                $user = $this->userRepository->create([
                      'name'             => $providerUser->name,
                      'email'            => $providerUser->email,
                      'slug'             => $providerUser->nickname,
                      'cover_url'        => $providerUser->avatar,
                ]);

                $socialAccount = $this->socialAccountRepository->create([
                    'user_id'                => $user->id,
                    'provider_id'            => $providerUser->id,
                    'provider'               => $providerName,
                    'provider_access_token'  => $providerUser->token,
                ]);

                return $user;
            });
        }

        if ($socialAccount) {
            $user = $this->userRepository->find($socialAccount->user_id);
        }

        return $user;
    }
}
