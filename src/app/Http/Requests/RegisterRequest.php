<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|',
        ];
    }

    public function messages(){
        return[
            'name.required' => '名前を入力してください',
            'name.string' => '文字列で入力してください',
            'name.max' => '255文字以下で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'emai.emai' => 'メール形式で入力してください',
            'emai.max' => '255文字以下で入力してください',
            'emai.' => 'このアドレスは既に使用されています',
            'password.required' => 'パスワードを入力してください',
            'password.string' => '文字列で入力してください',
            'password.min' => '8文字以上で入力してください',
        ];
    }
}
