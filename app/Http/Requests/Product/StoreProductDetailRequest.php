<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductDetailRequest extends FormRequest
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
            'color' => 'required|string|max:191',
            'import_quantity' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'import_price' => 'required|integer|min:0',
            'sale_price' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'color.required' => 'Màu sắc là trường bắt buộc.',
            'color.string' => 'Màu sắc phải là một chuỗi.',
            'color.max' => 'Màu sắc không được vượt quá 191 ký tự.',
            'import_quantity.required' => 'Số lượng nhập kho là trường bắt buộc.',
            'import_quantity.integer' => 'Số lượng nhập kho phải là một số nguyên.',
            'import_quantity.min' => 'Số lượng nhập kho không được nhỏ hơn 0.',
            'quantity.required' => 'Số lượng là trường bắt buộc.',
            'quantity.integer' => 'Số lượng phải là một số nguyên.',
            'quantity.min' => 'Số lượng không được nhỏ hơn 0.',
            'import_price.required' => 'Giá nhập kho là trường bắt buộc.',
            'import_price.integer' => 'Giá nhập kho phải là một số nguyên.',
            'import_price.min' => 'Giá nhập kho không được nhỏ hơn 0.',
            'sale_price.required' => 'Giá bán là trường bắt buộc.',
            'sale_price.integer' => 'Giá bán phải là một số nguyên.',
            'sale_price.min' => 'Giá bán không được nhỏ hơn 0.',
        ];
    }
}
