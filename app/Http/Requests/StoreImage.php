<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImage extends FormRequest
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
        'image_file' => ['filled', 'file', 'mimes:jpeg,png',],
        'image_name' => ['required', 'unique:images', 'regex:/[a-z0-9_-]+/', 'max:50'],
      ];
    }

    public function attributes(){
      return [
        'image_file' => '画像ファイル',
        'image_name' => 'ファイル名',
      ];
    }

    public function messages() {
      return [
        'image_file.required' => '画像ファイルを選択して下さい。',
        'image_name.regex' => 'ファイル名は「数字、英字(小文字)、-（ハイフン）、_（アンダーバー）」で入力して下さい。',
        'image_name.unique' => 'すでに使用されているファイル名です。',
      ];
    }
  }
