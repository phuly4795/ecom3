<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCatalogueStoreRequest;
use App\Http\Requests\UserCatalogueUpdateRequest;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    protected $LanguageRepositiory;

    public function __construct(
        LanguageRepository $LanguageRepositiory
    ) {
        $this->LanguageRepositiory = $LanguageRepositiory;
    }

    public function index(Request $request)
    {
        $input               = $request->all();
        $listUser = $this->LanguageRepositiory->search($input, [], $input['perpage'] ?? 20 );

        $config = config('apps.language.index');

        return view('admin.dashboard.user.catalogue.index', compact('listUser', 'config'));
    }

    public function create()
    {

        $config = config('apps.catalogue.create');

        $method = 'create';

      
        $location = [
            'province' => $this->LanguageRepositiory->all(),
        ];


        return view('admin.dashboard.user.catalogue.upsert', compact('config', 'location', 'method'));
    }

    public function store(UserCatalogueStoreRequest $request)
    {

        if ($this->UserCatalogueRepositiory->CreateUser($request)) {

            return redirect()->route('user.catalogue')->with('success', 'Thêm thành viên thành công');
        }

        return redirect()->route('user.catalogue')->with('error', 'Lỗi trong quá trình tạo thành viên');
    }

    public function edit($id)
    {

        $config = config('apps.catalogue.update');

        $infoUser = $this->UserCatalogueRepositiory->findById(['*'], [], $id);

        $infoUser->birthday = date('Y-m-d', strtotime($infoUser->birthday));

        $method = 'update';

        $location = [
            'province' => $this->ProvinceRepository->all(),
        ];

        return view('admin.dashboard.user.catalogue.upsert', compact('config', 'location', 'infoUser', 'method'));
    }

    public function update(UserCatalogueUpdateRequest $request, $id)
    {

        if ($this->UserCatalogueRepositiory->UpdateUser($id, $request)) {

            return redirect()->route('user.catalogue')->with('success', 'Cập nhật nhóm thành viên thành công');
        }

        return redirect()->route('user.catalogue')->with('error', 'Lỗi trong quá trình tạo thành viên');
    }

    public function delete($id)
    {

        if ($this->UserCatalogueRepositiory->DeleteUser($id)) {

            return redirect()->route('user.catalogue')->with('success', 'Xóa nhóm thành viên thành công');
        }

        return redirect()->route('user.catalogue')->with('error', 'Lỗi trong quá trình xóa thành viên');
    }

    public function updateStatus(Request $request)
    {   
        $id = $request->id;

        if ($this->UserCatalogueRepositiory->updateStatus($id)) {

          return 'thành công';
        }

        return 'Lỗi';
    }

    // public function updateStatusMultiple(Request $request)
    // {   
    //     $input =  $request->all();
    //     if ($this->UserCatalogueRepositiory->updateStatusMultiple($input)) {
    //       return response()->json(['flag' => $this->UserCatalogueRepositiory->updateStatusMultiple($input) ]);
    //     }

    //     return 'Lỗi';
    // }

}
