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
            'name' => 'required',
            'canonical' => 'unique:post_catalogue_languages|required',
        ];
    }

    public function messages()
    {
        return [
            'canonical.required' => 'Đường dẫn không được bỏ trống!',
            'canonical.unique' => 'Đường dẫn đã tồn tại!',
            'name.required' => 'Trường tiêu đề không được bỏ trống!',
        ];
    }
}
