<?php

namespace App\Repositories\Admin\Post;

use App\Models\PostCatalogue;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Classes\Nestedsetbie;

class PostCatalogueRepository extends BaseRepository
{
    protected $model;
    protected $Nestedsetbie;

    public function __construct(PostCatalogue $model)
    {
        $this->model = $model;
        $this->Nestedsetbie = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $this->currentLanguage()
        ]);
    }

    public function search($input = [], $with = [], $limit = null)
    {
        $query = $this->make($with);

        $this->sortBuilder($query, ['sort' => $input['sort']]);

        if (!empty($input['keyword'])) {
            $query->whereHas('postCatalogueLanguage', function ($q) use ($input) {
                $q->where('name', 'like', "%{$input['keyword']}%");
            });
        }

        if (isset($input['is_active']) && $input['is_active'] >= 0) {
            $query->where('is_active', $input['is_active']);
        }

        if ($limit) {
            // if ($limit === 1) {
            //     return $query->first();
            // } else {
            return $query->paginate($limit);
            // }
        } else {
            return $query->get();
        }
    }

    public function CreatePostCatalogue($request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $payload['created_by'] = auth()->user()->id;

            $postCatalogue =  $this->model->create($payload);
            if ($postCatalogue->id > 0) {
                $payloadLanguage = $request->only($this->payloadLanguage());
                $payloadLanguage['language_id'] = $this->currentLanguage();
                $payloadLanguage['post_catalogue_id'] = $postCatalogue->id;
                $language = $this->createLanguagePivot($postCatalogue, $payloadLanguage);
            }
            $this->Nestedsetbie->Get('level ASC, order ASC');
            $this->Nestedsetbie->Recursive(0, $this->Nestedsetbie->Set());
            $this->Nestedsetbie->Action();
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
            $PostCatalogue->is_active = ($PostCatalogue->is_active == 1) ? 0 : 1;
            $PostCatalogue->save();

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

    private function payload()
    {
        return ["parent_id", "follow", "is_active", "image"];
    }

    private function payloadLanguage()
    {
        return ["name", "description", "content", "meta_title", "meta_description", "meta_keyword", "canonical"];
    }

    public function findPostCatalogue(
        array $column = ['*'],
        array $relation = [],
        String $code,
        String $codeFind,
        int $id
    ) {
        return $this->model->select($column)->with($relation)->where($code, $codeFind)->findOrFail($id);
    }
}
