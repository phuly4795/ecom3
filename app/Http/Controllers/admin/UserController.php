<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\Admin\UserCatalogueRepositiory;
use App\Repositories\Admin\UserRepositiory;
use Illuminate\Http\Request;
use App\Repositories\ProvinceRepository as ProvinceRepository;



class UserController extends Controller
{
    protected $ProvinceRepository;
    protected $UserRepositiory;
    protected $UserCatalogueRepositiory;


    public function __construct(
        ProvinceRepository $ProvinceRepository,
        UserRepositiory $UserRepositiory,
        UserCatalogueRepositiory $UserCatalogueRepositiory
    ) {
        $this->ProvinceRepository = $ProvinceRepository;
        $this->UserRepositiory = $UserRepositiory;
        $this->UserCatalogueRepositiory = $UserCatalogueRepositiory;
    }

    public function index(Request $request)
    {
        $input               = $request->all();
        $listUser = $this->UserRepositiory->search($input, [], $input['perpage'] ?? 20 );

        $config = config('apps.user.index');

        return view('admin.dashboard.user.user.index', compact('listUser', 'config'));
    }

    public function create()
    {

        $config = config('apps.user.create');

        $method = 'create';
        
        $listCatalogue = $this->UserCatalogueRepositiory->listCatalogue();

        $location = [
            'province' => $this->ProvinceRepository->all(),
        ];

        return view('admin.dashboard.user.user.upsert', compact('config', 'location', 'method',  'listCatalogue'));
    }

    public function store(UserStoreRequest $request)
    {

        if ($this->UserRepositiory->CreateUser($request)) {

            return redirect()->route('user')->with('success', 'Thêm thành viên thành công');
        }

        return redirect()->route('user')->with('error', 'Lỗi trong quá trình tạo thành viên');
    }

    public function edit($id)
    {

        $config = config('apps.user.update');

        $infoUser = $this->UserRepositiory->findById(['*'], [], $id);

        $infoUser->birthday = date('Y-m-d', strtotime($infoUser->birthday));

        $method = 'update';

        $listCatalogue = $this->UserCatalogueRepositiory->listCatalogue();

        $location = [
            'province' => $this->ProvinceRepository->all(),
        ];

        return view('admin.dashboard.user.user.upsert', compact('config', 'location', 'infoUser', 'method', 'listCatalogue'));
    }

    public function update(UserUpdateRequest $request, $id)
    {

        if ($this->UserRepositiory->UpdateUser($id, $request)) {

            return redirect()->route('user')->with('success', 'Cập nhật thành viên thành công');
        }

        return redirect()->route('user')->with('error', 'Lỗi trong quá trình tạo thành viên');
    }

    public function delete($id)
    {

        if ($this->UserRepositiory->DeleteUser($id)) {

            return redirect()->route('user')->with('success', 'Xóa thành viên thành công');
        }

        return redirect()->route('user')->with('error', 'Lỗi trong quá trình xóa thành viên');
    }

    public function updateStatus(Request $request)
    {   
        $id = $request->id;

        if ($this->UserRepositiory->updateStatus($id)) {

          return 'thành công';
        }

        return 'Lỗi';
    }

    public function updateStatusMultiple(Request $request)
    {   
        $input =  $request->all();
        if ($this->UserRepositiory->updateStatusMultiple($input)) {
          return response()->json(['flag' => $this->UserRepositiory->updateStatusMultiple($input) ]);
        }

        return 'Lỗi';
    }

}
