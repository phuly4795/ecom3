<?php

namespace App\Repositories\Admin;

use App\Models\UserCatalogue;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserCatalogueRepositiory extends BaseRepository
{
    protected $model;

    public function __construct(UserCatalogue $model)
    {
        $this->model = $model;
    }


    public function search($input = [], $with = [], $limit = null)
    {
        $query = $this->make($with);
        // $this->sortBuilder($query, $input);

        if (!empty($input['keyword'])) {
            $query->where('name', 'like', "%{$input['keyword']}%")
                ->orWhere('code', 'like', "%{$input['keyword']}%")
                ->orWhere('description', 'like', "%{$input['keyword']}%");
        }

        if (!empty($with)) {
            foreach ($with as $count) {
                $query->withCount($count);
            }
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


    public function CreateUser($request)
    {
        DB::beginTransaction();
        try {
            $input = $request->except(['_token', 're_password']);
            $input['code'] = Str::slug($input['name']);
            $input['created_by'] = auth()->user()->id;
            $user = $this->model->create($input);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return false;
        }
    }

    public function UpdateUser($id, $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->except(['_token', '_method']);
            $input['code'] = Str::slug($input['name']);
            $user = $this->update($id, $input);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return false;
        }
    }

    public function DeleteUser($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->findById(['*'], [], $id)->delete();
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
            $userCatalogue = $this->findById(['*'], ['user'], $id);
            $userCatalogue->is_active = ( $userCatalogue->is_active == 1 ) ? 0 : 1;
            $userCatalogue->save();

            $users = $userCatalogue->user;
            foreach ($users as $user) {
                $user->is_active = ( $user->is_active == 1 ) ? 0 : 1;
                $user->save();
            }

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return false;
        }
    }

    public function listCatalogue()
    {
        $listCatalogue =   $this->model->all();

        return $listCatalogue;
    }

    // public function updateStatusMultiple($input)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $array_id = $input['id'];
    //         $field = $input['field'];
    //         $value = $input['value'];
    //         $payload[$field] = ($value == 1 ) ? 0 : 1; 
    //         $user = $this->updateByWhereIn('id', $array_id, $payload); 
    //         DB::commit();
    //         return true;
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         dd($th);
    //         return false;
    //     }
    // }
}
