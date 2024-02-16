<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'name'=>'required|unique:suppliers',
            'email'=>'required|email|unique:suppliers',
            'phone' => [
                'required',
                'regex:/^\d{10,15}$/',
            ],
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'Vui lòng nhập tên nhà cung cấp.',
        'name.unique' => 'Nhà cung cấp với tên ":input" đã tồn tại.',
        'email.required' => 'Vui lòng nhập địa chỉ email.',
        'email.email' => 'Địa chỉ email không hợp lệ.',
        'email.unique' => 'Địa chỉ email ":input" đã được sử dụng bởi nhà cung cấp khác.',
        'phone.required' => 'Vui lòng nhập số điện thoại.',
        'phone.regex' => 'Số điện thoại không hợp lệ.',
    ];
}
}
