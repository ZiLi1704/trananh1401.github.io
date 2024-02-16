<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        $ignoreId = $this->route('category');
        $brandId = $this->input('brand_id');
        $parentCategoryId = $this->input('parent_id');

        $uniqueRule = $ignoreId ? ',' . $ignoreId->id : '';

        $rules = [
            'name' => [
                'required',
                function ($attribute, $value, $fail) use ($brandId, $ignoreId, $parentCategoryId) {
                    if ($parentCategoryId) {
                        // Kiểm tra unique chỉ khi parent_id có giá trị
                        if (!Category::isNameUniqueForBrandAndParent($value, $brandId, $parentCategoryId, $ignoreId)) {
                            $fail("Danh mục đã tồn tại trong thương hiệu và danh mục cha này");
                        }
                    } else {
                        // Kiểm tra unique khi không có parent_id
                        if (!Category::isNameUniqueForBrand($value, $brandId, $ignoreId)) {
                            $fail("Danh mục đã tồn tại trong thương hiệu này");
                        }
                    }
                },
            ],
        ];

        if ($parentCategoryId) {
            // Thêm quy tắc cho parent_id nếu có giá trị
            $rules['parent_id'] = 'exists:categories,id';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Tên danh mục đã tồn tại trong thương hiệu và danh mục cha này',
            'parent_id.exists' => 'Danh mục cha không hợp lệ',
        ];
    }
}
