<?php

namespace App\Repositories;

use App\Models\Ward;
use App\Repositories\BaseRepository;

class WardRepository extends BaseRepository
{
    protected $model;

    public function __construct( Ward $model)
    {
        $this->model = $model;
    }   
}