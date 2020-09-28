<?php
namespace App\Repositories\Message;

use App\Repositories\Base\BaseRepositoryInterface;

interface MessageRepositoryInterface extends BaseRepositoryInterface
{
    public function getBlankModel();

    /**
     * 投稿は一日一回に制限している
     * DBに一日前に投稿がないか確認する.
     *
     * @param int $userId
     *
     * @return bool
     */
    public function isUserAlreadyStoreByOneday(int $userId): bool;
}
