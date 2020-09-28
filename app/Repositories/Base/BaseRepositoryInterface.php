<?php
namespace App\Repositories\Base;

interface BaseRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function findWithTrashed(int $id);

    public function delete($model);

    public function create(array $input);

    public function firstOrCreate(array $input);

    public function update($model, array $input);

    public function getIdOptions();
}
