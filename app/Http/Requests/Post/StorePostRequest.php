<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
        ];
    }

    /**
     * Customize the error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Tên bài viết không được để trống.',
            'title.max' => 'Tên bài viết không được vượt quá 255 ký tự.',
            'image.required' => 'Ảnh minh họa không được để trống.',
            'image.image' => 'Ảnh minh họa phải là hình ảnh.',
            'image.mimes' => 'Định dạng hình ảnh không hợp lệ.',
            'image.max' => 'Kích thước ảnh không được vượt quá 2048 KB.',
            'content.required' => 'Nội dung không được để trống.',
        ];
    }
}
