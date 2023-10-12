<?php

namespace App\Repositories;

use App\Models\Province;
use App\Repositories\BaseRepository;

class ProvinceRepository extends BaseRepository
{
    protected $model;

    public function __construct( Province $model)
    {
        $this->model = $model;
    }   

 
}