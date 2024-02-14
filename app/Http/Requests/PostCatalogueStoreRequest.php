<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCatalogueStoreRequest extends FormRequest
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
            'canonical' => 'unique:languages|required',
            'name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'canonical.unique' => 'Trùng mã',
            'canonical.required' => 'không được bỏ trống!',
            'name.required' => 'Trường tên không được bỏ trống!',
            'name.string' => 'tên phải là dạng ký tự!',
            'name.max' => 'tên tối đa chỉ được 255 kí tự!',
        ];
    }
}
