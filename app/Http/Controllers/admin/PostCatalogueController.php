<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCatalogueStoreRequest;
use App\Http\Requests\PostCatalogueUpdateRequest;
use App\Repositories\Admin\Post\PostCatalogueRepository;
use Illuminate\Http\Request;

class PostCatalogueController extends Controller
{
    protected $PostCatalogueRepositiory;

    public function __construct(
        PostCatalogueRepository $PostCatalogueCatalogueRepository
    ) {
        $this->PostCatalogueRepositiory = $PostCatalogueCatalogueRepository;
    }

    public function index(Request $request)
    {
        $input               = $request->all();
        $listPostCatalogue = $this->PostCatalogueRepositiory->search($input, [], $input['perpage'] ?? 20);

        $config = config('apps.post-catalogue.index');

        return view('admin.dashboard.post.catalogue.index', compact('listPostCatalogue', 'config'));
    }

    public function create()
    {

        $config = config('apps.post-catalogue.create');

        $method = 'create';

        return view('admin.dashboard.post.catalogue.upsert', compact('config', 'method'));
    }

    public function store(PostCatalogueStoreRequest $request)
    {

        if ($this->PostCatalogueRepositiory->CreatePostCatalogue($request)) {

            return redirect()->route('PostCatalogue')->with('success', 'Thêm ngôn ngữ thành công');
        }

        return redirect()->route('PostCatalogue')->with('error', 'Lỗi trong quá trình tạo ngôn ngữ');
    }

    public function edit($id)
    {

        $config = config('apps.PostCatalogue.update');

        $infoPostCatalogue = $this->PostCatalogueRepositiory->findById(['*'], [], $id);

        $method = 'update';

        return view('admin.dashboard.PostCatalogue.upsert', compact('config', 'infoPostCatalogue', 'method'));
    }

    public function update(PostCatalogueUpdateRequest $request, $id)
    {
        $input = $request->all();
        if ($this->PostCatalogueRepositiory->update($id, $input)) {

            return redirect()->route('PostCatalogue')->with('success', 'Cập nhật thành công');
        }

        return redirect()->route('PostCatalogue')->with('error', 'Lỗi trong quá trình tạo thành viên');
    }

    public function delete($id)
    {

        if ($this->PostCatalogueRepositiory->DeletePostCatalogue($id)) {

            return redirect()->route('PostCatalogue')->with('success', 'Xóa ngôn ngữ thành công');
        }

        return redirect()->route('user.catalogue')->with('error', 'Lỗi trong quá trình xóa thành viên');
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;

        if ($this->PostCatalogueRepositiory->updateStatus($id)) {
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
