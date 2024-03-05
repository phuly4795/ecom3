<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCatalogueUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'canonical' => 'required|unique:post_catalogue_languages,canonical, ' . $this->id . ',post_catalogue_id',
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'canonical.unique' => 'Đường dẫn đã tồn tại!',
            'canonical.required' => 'Trường đường dẫn không được bỏ trống!',
            'name.required' => 'Trường Name không được bỏ trống!',
        ];
    }
}
