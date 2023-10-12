<?php

namespace App\Repositories;

use App\Models\District;
use App\Repositories\BaseRepository;

class DistrictRepository extends BaseRepository
{
    protected $model;

    public function __construct( District $model)
    {
        $this->model = $model;
    }   

    public function findDistrictByProvinceCode($province_code = 0) {
       return $this->model->where('city_code', $province_code)->get();
    }


}