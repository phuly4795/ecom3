<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|string|unique:users,email,'.$this->id.'|max:255',
            'name' => 'required|string',
            // 'user_catalogue_id' => 'required|integer|gt:0',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Trường email không được bỏ trống!',
            'email.unique' => 'Email đã tồn tại!',
            'email.email' => 'Email không đúng định dạng!',
            'email.string' => 'Email phải là dạng ký tự!',
            'email.max' => 'Email tối đa là 255 ký tự!',
            'name.required' => 'Trường họ tên không được bỏ trống!',
            'name.string' => 'Họ tên phải là dạng ký tự!',
            'user_catalogue_id.gt' => 'Bạn chưa chọn nhóm thành viên',
        ];
    }
}
