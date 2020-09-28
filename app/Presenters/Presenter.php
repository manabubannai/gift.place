<?php
namespace App\Presenters;

use Illuminate\Database\Eloquent\Model;

abstract class Presenter
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->model, $method], $args);
    }

    public function __get($name)
    {
        return $this->model->$name;
    }
}
