<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageStoreRequest;
use App\Http\Requests\LanguageUpdateRequest;
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
        $listLanguage = $this->LanguageRepositiory->search($input, [], $input['perpage'] ?? 20);

        $config = config('apps.language.index');

        return view('admin.dashboard.language.index', compact('listLanguage', 'config'));
    }

    public function create()
    {

        $config = config('apps.language.create');

        $method = 'create';

        return view('admin.dashboard.language.upsert', compact('config', 'method'));
    }

    public function store(LanguageStoreRequest $request)
    {

        if ($this->LanguageRepositiory->CreateLanguage($request)) {

            return redirect()->route('language')->with('success', 'Thêm ngôn ngữ thành công');
        }

        return redirect()->route('language')->with('error', 'Lỗi trong quá trình tạo ngôn ngữ');
    }

    public function edit($id)
    {

        $config = config('apps.language.update');

        $infoLanguage = $this->LanguageRepositiory->findById(['*'], [], $id);

        $method = 'update';

        return view('admin.dashboard.language.upsert', compact('config', 'infoLanguage', 'method'));
    }

    public function update(LanguageUpdateRequest $request, $id)
    {
        $input = $request->all();
        if ($this->LanguageRepositiory->update($id, $input)) {

            return redirect()->route('language')->with('success', 'Cập nhật thành công');
        }

        return redirect()->route('language')->with('error', 'Lỗi trong quá trình tạo thành viên');
    }

    public function delete($id)
    {

        if ($this->LanguageRepositiory->DeleteLanguage($id)) {

            return redirect()->route('language')->with('success', 'Xóa ngôn ngữ thành công');
        }

        return redirect()->route('user.catalogue')->with('error', 'Lỗi trong quá trình xóa thành viên');
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;

        if ($this->LanguageRepositiory->updateStatus($id)) {
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
