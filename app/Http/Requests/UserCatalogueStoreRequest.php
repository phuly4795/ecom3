<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCatalogueStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'unique:user_catalogues',
            'name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'Tên nhóm đã tồn tại',
            'name.required' => 'Trường tên nhóm không được bỏ trống!',
            'name.string' => 'tên nhóm phải là dạng ký tự!',
            'name.max' => 'tên nhóm tối đa chỉ được 255 kí tự!',
        ];
    }
}
