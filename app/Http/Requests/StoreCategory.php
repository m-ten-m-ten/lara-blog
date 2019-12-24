<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
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
    public function rules(){
      return [
        'category_title' => ['required', 'unique:categories', 'max:15'],
        'category_name' => ['required', 'unique:categories', 'regex:/[a-z0-9_-]+/', 'max:25'],
      ];
    }

    public function attributes(){
      return [
        'category_title' => 'カテゴリー名',
        'category_name' => 'カテゴリースラッグ',
      ];
    }

    public function messages(){
      return [
        'category_name.regex' => 'カテゴリースラッグは「数字、英字(小文字)、-（ハイフン）、_（アンダーバー）」で入力して下さい。',
      ];
    }
}
