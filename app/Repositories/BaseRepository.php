<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct( Model $model)
    {
        $this->model = $model;
    }   

    public function create($input = [])
    {
        $model = $this->model->create($input);
       return $model->fresh();
    }   

    public function all()
    {
       return $this->model->all();
    }   

    public function findByCode(
        $column = ['*'],
        $relation = [],
        $code = 'code',
        $codeFind
    )
    {
       return $this->model->select($column)->with($relation)->where($code , $codeFind)->firstOrFail();
    }   

}
