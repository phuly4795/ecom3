<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Repositories\Admin\UserRepositiory;
use Illuminate\Http\Request;
use App\Repositories\ProvinceRepository as ProvinceRepository;



class UserController extends Controller
{
    protected $ProvinceRepository;
    protected $UserRepositiory;
    
    public function __construct(
        ProvinceRepository $ProvinceRepository,
        UserRepositiory $UserRepositiory
    )
    {
        $this->ProvinceRepository = $ProvinceRepository;
        $this->UserRepositiory = $UserRepositiory;
    }

    public function index()
    {
        $listUser = User::latest('created_at')->paginate(10);

        $config = config('apps.user.index');

        return view('admin.dashboard.user.index', compact('listUser', 'config'));
    }

    public function create() {

        $config = config('apps.user.create');
        
        $location = [ 
            'province' => $this->ProvinceRepository->all(),
        ];

        return view('admin.dashboard.user.create', compact( 'config', 'location'));
    }

    public function store(UserStoreRequest $request) {
        
        if( $this->UserRepositiory->CreateUser($request)){
            return redirect()->route('user')->with('success','Thêm thành viên thành công');
        }

        return redirect()->route('user')->with('error','Lỗi trong quá trình tạo thành viên');

    }

}
