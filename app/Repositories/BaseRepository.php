<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function create($input = [])
    {
        $model = $this->model->create($input);
        return $model->fresh();
    }

    public function update(int $id = 0, array $input = [])
    {
        $model = $this->findById(['*'], [], $id);
        return $model->update($input);
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
    ) {
        return $this->model->select($column)->with($relation)->where($code, $codeFind)->firstOrFail();
    }

    public function findById(
        array $column = ['*'],
        array $relation = [],
        int $id
    ) {
        return $this->model->select($column)->with($relation)->findOrFail($id);
    }

    public function make(array $with = [])
    {
        return $this->model->with($with);
    }

    public function sortBuilder(&$query, $attributes = [])
    {
        $validConditions = ['asc', 'desc'];
        $validColumn     = DB::getSchemaBuilder()->getColumnListing($this->getTable());

        if (empty($attributes['sort'])) {
            $attributes['sort'] = ['updated_at' => 'desc'];
        }
        foreach ($attributes['sort'] as $key => $value) {

            if (!$value) {
                $value = 'asc';
            }

            if (!in_array($value, $validConditions)) {
                continue;
            }

            if (!in_array($key, $validColumn)) {
                continue;
            }
            $query->orderBy($key, $value);
        }
    }

    public function getTable()
    {
        return $this->model->getTable();
    }


    public function updateByWhereIn($column, $array, $payload)
    {
        return $this->model->whereIn($column, $array)->update($payload);
    }
}
