<?php
namespace App\Repositories\Base;

class BaseRepository implements BaseRepositoryInterface
{
    public function all()
    {
        $model = $this->getBlankModel();

        return $model->all();
    }

    public function find(int $id)
    {
        $model = $this->getBlankModel();

        return $model->where('id', $id)->first();
    }

    public function findWithTrashed(int $id)
    {
        $model = $this->getBlankModel();

        return $model->withTrashed()->where('id', $id)->first();
    }

    public function delete($model)
    {
        return $model->delete();
    }

    public function create(array $input)
    {
        $model = $this->getBlankModel();

        return $model->create($input);
    }

    public function firstOrCreate(array $input)
    {
        $model = $this->getBlankModel();

        return $model->firstOrCreate($input);
    }

    public function update($model, array $input)
    {
        $model->fill($input)->save();

        return $model;
    }

    public function getIdOptions()
    {
        $idOptions = [];
        $model     = $this->getBlankModel();
        $tmp       = $model::orderBy('id')->get(['id', 'name']);
        if ($tmp->isNotEmpty()) {
            $list = $tmp->all();
            foreach ($list as $v) {
                if ($v->name == null) {
                    $idOptions[$v->id] = $v->id;
                } else {
                    $idOptions[$v->id] = $v->name;
                }
            }
        }

        return $idOptions;
    }
}
