<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => [
                'required',
                function ($attribute, $value, $fail) {
                    $brandId = $this->input('brand_id');
                    $ignoreId = $this->route('category');

                    // Sử dụng $attribute trong câu lệnh điều kiện
                    if (!Category::isNameUniqueForBrand($value, $brandId, $ignoreId)) {
                        $fail("$value đã tồn tại cho ");
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => "Tên danh mục không được để trống",
        ];
    }
}
