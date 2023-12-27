<?php

namespace App\Repositories;

use App\Models\Language;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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

    public function CreateLanguage($request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $input['created_by'] = auth()->user()->id;
            $this->model->create($input);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return false;
        }
    }
 
    public function DeleteLanguage($id)
    {
        DB::beginTransaction();
        try {
            $language = $this->findById(['*'], [], $id)->delete();
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return false;
        }
    }

    public function updateStatus($id)
    {

        DB::beginTransaction();
        try {
            $language = $this->findById(['*'], [], $id);
            $language->is_active = ( $language->is_active == 1 ) ? 0 : 1;
            $language->save();

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return false;
        }
    }
}