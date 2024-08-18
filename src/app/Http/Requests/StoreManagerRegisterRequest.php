<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\StoreManager;

class StoreManagerRegisterRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => [
            'required',
            'email',
            'max:255',
                function ($attribute, $value, $fail) {
                    if (User::where('email', $value)->exists() || StoreManager::where('email', $value)->exists()) {
                        $fail('このアドレスは既に使用されています');
                    }
                },
            ],
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(){
        return[
            'name.required' => '名前を入力してください',
            'name.string' => '文字列で入力してください',
            'name.max' => '255文字以下で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メール形式で入力してください',
            'email.max' => '255文字以下で入力してください',
            'email.unique' => 'このアドレスは既に使用されています',
            'password.required' => 'パスワードを入力してください',
            'password.string' => '文字列で入力してください',
            'password.min' => '8文字以上で入力してください',
            'password.confirmed' => '確認用パスワードが一致しません',
            
        ];
    }
}
