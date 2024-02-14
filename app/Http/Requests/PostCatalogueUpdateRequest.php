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
            'code' => 'unique:languages,code,' . $this->id . '',
            'name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'Code đã tồn tại!',
            'name.required' => 'Trường Name không được bỏ trống!',
            'name.string' => 'Name phải là dạng ký tự!',
            'name.max' => 'Name tối đa chỉ được 255 kí tự!',
        ];
    }
}
