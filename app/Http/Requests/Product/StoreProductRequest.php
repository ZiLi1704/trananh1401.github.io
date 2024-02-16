<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'product_code' => 'required|string|max:255',
            'key_type' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'keyboard_type' => 'nullable|string|max:255',
            'switch' => 'nullable|string|max:255',
            'backlight' => 'nullable|string|max:255',
            'battery' => 'nullable|string|max:255',
            'size' => 'required|string|regex:/^\d+\s*mm\s*x\s*\d+\s*mm\s*x\s*\d+\s*mm$/',
            'weight' => 'required|numeric',
            'compatibility' => 'nullable|string|max:255',
            'warranty' => 'nullable|integer|in:6,12,24',
            'image' => 'nullable|image|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'category_id.required' => 'Danh mục không được để trống',
            'category_id.exists' => 'Danh mục không tồn tại',
            'product_code.required' => 'Mã sản phẩm không được để trống',
            'material.required' => 'Chất liệu không được để trống',
            'keyboard_type.required' => 'Layout Phím không được để trống',
            'switch.required' => 'Công tắc cơ không được để trống',
            'battery.required' => 'Sử dụng không được để trống',
            'size.required' => 'Kích thước không được để trống',
            'weight.required' => 'Khối lượng không được để trống',
            'weight.numeric' => 'Khối lượng phải là số',
            'compatibility.required' => 'Khả năng thích nghi không được để trống',
            'warranty.required' => 'Bảo hành không được để trống',
            'image.image' => 'Hình ảnh không hợp lệ',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB',
        ];
    }
}
