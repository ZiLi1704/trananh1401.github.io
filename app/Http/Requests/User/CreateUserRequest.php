<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'Vui lòng nhập tên người dùng.',
        'name.string' => 'Tên người dùng phải là một chuỗi.',
        'name.max' => 'Tên người dùng không được vượt quá :max ký tự.',

        'email.required' => 'Vui lòng nhập địa chỉ email.',
        'email.email' => 'Địa chỉ email phải là một địa chỉ email hợp lệ.',
        'email.unique' => 'Địa chỉ email đã tồn tại.',

        'phone.required' => 'Vui lòng nhập số điện thoại.',
        'phone.unique' => 'Số điện thoại đã tồn tại.',
        'phone.string' => 'Số điện thoại phải là một chuỗi.',
        'phone.max' => 'Số điện thoại không được vượt quá :max ký tự.',

        'address.required' => 'Vui lòng nhập địa chỉ.',
        'address.string' => 'Địa chỉ phải là một chuỗi.',
        'address.max' => 'Địa chỉ không được vượt quá :max ký tự.',

        'password.required' => 'Vui lòng nhập mật khẩu.',
        'password.string' => 'Mật khẩu phải là một chuỗi.',
        'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
    ];
}
}
