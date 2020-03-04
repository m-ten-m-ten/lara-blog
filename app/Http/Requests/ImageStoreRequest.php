<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ImageStoreRequest extends FormRequest
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
            'image_files'   => 'required',
            'image_files.*' => [
                'image',
                'mimes:jpeg,png',
                function ($attribute, $value, $fail) {
                    $file_name = $value->getClientOriginalName();
                    $image_name = \rtrim($file_name, '.' . $value->getClientOriginalExtension());

                    if (\preg_match('/^[-_a-z0-9]{0,50}$/', $image_name) === 0) {
                        return $fail('ファイル名は「数字、英字(小文字)、-（ハイフン）、_（アンダーバー）」(50字以内)で入力して下さい。');
                    }

                    if (DB::table('images')->where('file_name', $file_name)->exists()) {
                        return $fail('ファイル名が既に登録されています。');
                    }
                },
            ],
        ];
    }

    public function attributes()
    {
        return [
            'image_files'   => '画像ファイル',
            'image_files.*' => '画像ファイル',
        ];
    }

    public function messages()
    {
        return [
            'image_files.required'    => '画像ファイルを選択して下さい。',
            'image_files.*.image'     => '画像ファイルを選択して下さい。',
            'image_files.*.mimes'     => '画像ファイルはjpegかpng形式にして下さい。',
        ];
    }
}
