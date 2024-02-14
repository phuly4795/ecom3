<?php

namespace App\Repositories\Admin\Post;

use App\Models\PostCatalogue;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PostCatalogueRepository extends BaseRepository
{
    protected $model;

    public function __construct( PostCatalogue $model)
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

    public function CreatePostCatalogue($request)
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
 
    public function DeletePostCatalogue($id)
    {
        DB::beginTransaction();
        try {
            $PostCatalogue = $this->findById(['*'], [], $id)->delete();
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
            $PostCatalogue = $this->findById(['*'], [], $id);
            $PostCatalogue->is_active = ( $PostCatalogue->is_active == 1 ) ? 0 : 1;
            $PostCatalogue->save();

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return false;
        }
    }
}