<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
        'date' => 'required|date_format:Y-m-d',
        'time' => 'required|date_format:H:i',
        'guest_count' => 'required|min:1',
      ];
    }

    public function messages(){
      return[
        'date.required' => '日付を選択してください',
        'date.date_format' => '表示された形式で入力してください',
        'time.required' => '時間を選択してください',
        'date.date_format' => '表示された形式で入力してください',
        'guest_count.required' => '人数を選択してください',
        'guest_count.min' => '1人以上で選択してください',
      ];
    }
}
