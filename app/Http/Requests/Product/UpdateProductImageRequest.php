<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductImageRequest extends FormRequest
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
            'image_name' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'image_name.required' => 'Vui lòng chọn ảnh.',
            'image_name.image' => 'Tệp phải là hình ảnh.',
            'image_name.mimes' => 'Hình ảnh phải có định dạng là jpeg, png, jpg, gif.',
            'image_name.max' => 'Dung lượng tối đa cho phép là 2048 KB.',
        ];
    }
}
