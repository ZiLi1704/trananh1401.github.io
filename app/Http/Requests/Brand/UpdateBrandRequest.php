<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
        $uniqueRule = $this->route('brand') ? ',' . $this->route('brand')->id : '';

        return [
            'name' => 'required|unique:brands,name' . $uniqueRule,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => "$this->name đã tồn tại",
        ];
    }
}
