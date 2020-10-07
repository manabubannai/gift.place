<?php
namespace App\Repositories\SocialAccount;

use App\Repositories\Base\BaseRepositoryInterface;

interface SocialAccountRepositoryInterface extends BaseRepositoryInterface
{
    public function getBlankModel();
}
