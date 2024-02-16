<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
        // Kiểm tra nếu id tồn tại, thêm điều kiện unique
        $uniqueRule = $this->route('supplier') ? ',' . $this->route('supplier')->id : '';

        return [
            'name' => 'required|unique:suppliers,name' . $uniqueRule,
            'email' => 'required|email|unique:suppliers,email' . $uniqueRule,
            'phone' => [
                'required',
                'regex:/^\d{10,15}$/',
                'unique:suppliers,phone' . $uniqueRule,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên nhà cung cấp không được để trống.',
            'name.unique' => 'Nhà cung cấp với tên ":input" đã tồn tại.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email ":input" đã được sử dụng bởi nhà cung cấp khác.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'phone.unique' => 'Số điện thoại ":input" đã được sử dụng bởi nhà cung cấp khác.',
        ];
    }
}
