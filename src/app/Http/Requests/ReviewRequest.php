<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rating' => 'required|integer|min:1|max:5', 
            'comment' => 'nullable|string|max:400',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048', 
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '評価は必須です。',
            'rating.integer' => '評価は整数である必要 があります。',
            'rating.min' => '評価は1以上である必要があります。',
            'rating.max' => '評価は5以下である必要があります。',
            'comment.max' => 'コメントは400文字以内で入力してください。',
            'image.image' => 'アップロードできるのは画像のみです。',
            'image.mimes' => 'jpegまたはpng形式の画像をアップロードしてください。',
            'image.max' => '画像サイズは最大2MBです。',
        ];
    }
}
