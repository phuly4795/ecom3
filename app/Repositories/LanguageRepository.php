<?php

namespace App\Repositories;

use App\Models\Language;
use App\Repositories\BaseRepository;

class LanguageRepository extends BaseRepository
{
    protected $model;

    public function __construct( Language $model)
    {
        $this->model = $model;
    }   

    public function search($input = [], $with = [], $limit = null)
    {
        $query = $this->make($with);
        $input['sort'] = ['created_at' => 'DESC'];
        $this->sortBuilder($query, $input['sort']);

        if (!empty($input['keyword'])) {
            $query->where('name', 'like', "%{$input['keyword']}%")
                ->orWhere('email', 'like', "%{$input['keyword']}%")
                ->orWhere('phone', 'like', "%{$input['keyword']}%")
                ->orWhere('address', 'like', "%{$input['keyword']}%")
                ->orWhere('user_catalogue_id', "{$input['user_catalogue_id']}");
        }

        if (!empty($input['user_catalogue_id'])) {
            $query->Where('user_catalogue_id', "{$input['user_catalogue_id']}");
        }

        if ($limit) {
            if ($limit === 1) {
                return $query->first();
            } else {
                return $query->paginate($limit);
            }
        } else {
            return $query->get();
        }
    }
 
}