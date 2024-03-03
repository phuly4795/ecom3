<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCatalogueStoreRequest;
use App\Http\Requests\PostCatalogueUpdateRequest;
use App\Repositories\Admin\Post\PostCatalogueRepository;
use Illuminate\Http\Request;
use App\Classes\Nestedsetbie;

class PostCatalogueController extends Controller
{
    protected $PostCatalogueRepositiory;
    protected $Nestedsetbie;

    public function __construct(
        PostCatalogueRepository $PostCatalogueRepositiory,
    ) {
        $this->PostCatalogueRepositiory = $PostCatalogueRepositiory;
        $this->Nestedsetbie = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $PostCatalogueRepositiory->currentLanguage()
        ]);
    }

    public function index(Request $request)
    {
        $input               = $request->all();
        $input['sort'] = ['lft' => 'asc'];
        $listPostCatalogue = $this->PostCatalogueRepositiory->search($input, ['postCatalogueLanguage'], $input['perpage'] ?? 20);
        $config = config('apps.post-catalogue.index');

        return view('admin.dashboard.post.catalogue.index', compact('listPostCatalogue', 'config'));
    }

    public function create()
    {

        $config = config('apps.post-catalogue.create');

        $method = 'create';

        $dropdown = $this->Nestedsetbie->Dropdown();

        return view('admin.dashboard.post.catalogue.upsert', compact('config', 'method', 'dropdown'));
    }

    public function store(PostCatalogueStoreRequest $request)
    {
        if ($this->PostCatalogueRepositiory->CreatePostCatalogue($request)) {

            return redirect()->route('post-catalogue')->with('success', 'Thêm ngôn ngữ thành công');
        }

        return redirect()->route('post-catalogue')->with('error', 'Lỗi trong quá trình tạo ngôn ngữ');
    }

    public function edit($id)
    {

        $config = config('apps.post-catalogue.update');

        $infoPostCatalogue = $this->PostCatalogueRepositiory->findPostCatalogue(['*'], ['postCatalogueLanguage'], 'language_id', $this->PostCatalogueRepositiory->currentLanguage(), $id);
        dd($infoPostCatalogue);
        $method = 'update';
        $dropdown = $this->Nestedsetbie->Dropdown();
        return view('admin.dashboard.post.catalogue.upsert', compact('config', 'infoPostCatalogue', 'method', 'dropdown'));
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

    public function updateStatusMultiple(Request $request)
    {
        $input =  $request->all();
        if ($this->PostCatalogueRepositiory->updateStatusMultiple($input)) {
            return response()->json(['flag' => $this->PostCatalogueRepositiory->updateStatusMultiple($input)]);
        }

        return 'Lỗi';
    }
}
