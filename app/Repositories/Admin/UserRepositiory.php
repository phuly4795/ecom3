<?php

namespace App\Repositories\Admin;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepositiory extends BaseRepository
{
    protected $model;

    public function __construct(User $model)
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


    public function CreateUser($request)
    {
        DB::beginTransaction();
        try {
            $input = $request->except(['_token', 're_password']);
            $input['password'] = Hash::make($input['password']);
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
            $user = $this->findById(['*'], [], $id);
            $user->is_active = ($user->is_active == 1) ? 0 : 1;
            $user->save();
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return false;
        }
    }

    public function updateStatusMultiple($input)
    {
        DB::beginTransaction();
        try {
            $array_id = $input['id'];
            $field = $input['field'];
            $value = $input['value'];
            $payload[$field] = ($value == 1) ? 0 : 1;
            $user = $this->updateByWhereIn('id', $array_id, $payload);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return false;
        }
    }
}
