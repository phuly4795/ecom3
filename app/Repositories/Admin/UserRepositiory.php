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

    public function __construct( User $model)
    {
        $this->model = $model;
    }   

    public function CreateUser($request) {
        DB::beginTransaction();
        try {
            $input = $request->except(['_token','re_password']);
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


}