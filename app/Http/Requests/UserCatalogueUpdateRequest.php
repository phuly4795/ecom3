<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCatalogueUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'code' => 'unique:user_catalogues,code,' . $this->id . '',
            'name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'Email đã tồn tại!',
            'name.required' => 'Trường họ tên không được bỏ trống!',
            'name.string' => 'Họ tên phải là dạng ký tự!',
            'name.max' => 'tên nhóm tối đa chỉ được 255 kí tự!',
        ];
    }
}
