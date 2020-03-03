<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
            'image_file' => [
                'filled',
                'file',
                'mimes:jpeg,png',
                function ($attribute, $value, $fail) {
                    $image_name = \rtrim($value->getClientOriginalName(), '.' . $value->getClientOriginalExtension());
                    if (preg_match('/^[-_a-z0-9]{0,50}$/', $image_name) === 0) {
                        return $fail('ファイル名は「数字、英字(小文字)、-（ハイフン）、_（アンダーバー）」(50字以内)で入力して下さい。');
                    }
                }
            ]
        ];
    }

    public function attributes()
    {
        return [
            'image_file' => '画像ファイル',
            // 'image_name' => 'ファイル名',
        ];
    }

    public function messages()
    {
        return [
            'image_file.filled'   => '画像ファイルを選択して下さい。',
            'image_file.file'     => '画像ファイルのアップロードに失敗しました。再度ご登録下さい。',
        ];
    }

    /**
     * validated()をOverride。画像ファイルのs3へのアップロード。
     *
     * @return object バリデータ
     */
    public function validated()
    {
        $validatedData = parent::validated();

        $validatedData['file_name'] = $validatedData['image_file']->getClientOriginalName();
        Storage::disk('s3')->putFileAs('/img', $validatedData['image_file'], $validatedData['file_name'], 'public');
        $validatedData['path'] = Storage::disk('s3')->url('img/' . $validatedData['file_name']);

        return $validatedData;
    }
}
