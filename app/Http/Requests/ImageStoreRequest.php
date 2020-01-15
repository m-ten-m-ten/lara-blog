<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
            'image_file' => ['filled', 'file', 'mimes:jpeg,png'],
            'image_name' => ['required', Rule::unique('images')->ignore($this->image), 'max:50', 'regex:/^[-_a-z0-9]{1,50}$/'],
        ];
    }

    public function attributes()
    {
        return [
            'image_file' => '画像ファイル',
            'image_name' => 'ファイル名',
        ];
    }

    public function messages()
    {
        return [
            'image_file.filled'   => '画像ファイルを選択して下さい。',
            'image_file.file'     => '画像ファイルのアップロードに失敗しました。再度ご登録下さい。',
            'image_name.regex'    => 'ファイル名は「数字、英字(小文字)、-（ハイフン）、_（アンダーバー）」で入力して下さい。',
            'image_name.unique'   => 'すでに使用されているファイル名です。',
        ];
    }

    public function validated()
    {
        $validated = parent::validated();

        if (isset($validated['image_file'])) {
            $validated['image_extension'] = $validated['image_file']->extension();
            $validated['image_file']->move(public_path() . '/img', $validated['image_name'] . '.' . $validated['image_extension']);
        } else {
            \rename(public_path() . '/img/' . $this->image->image_name . '.' . $this->image->image_extension, public_path() . '/img/' . $validated['image_name'] . '.' . $this->image->image_extension);
        }

        return $validated;
    }
}
