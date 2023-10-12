<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email' => 'required|email|string|unique:users|max:255',
            'name' => 'required|string',
            // 'user_catalogue_id' => 'required|integer|gt:0',
            'password' => 'required|string|min:6',
            're_password' => 'required|string|same:password',
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
            'password.required' => 'Trường mật khẩu không được bỏ trống!',
            'password.min' => 'Mật khẩu phải có hơn 6 ký tự!',
            'password.string' => 'Mật khẩu phải là dạng ký tự!',
            're_password.required' => 'Trường nhập lại mật khẩu không được bỏ trống!',
            're_password.string' => 'Mật khẩu phải là dạng ký tự!',
            're_password.same' => 'mật khẩu không khớp',
        ];
    }
}
