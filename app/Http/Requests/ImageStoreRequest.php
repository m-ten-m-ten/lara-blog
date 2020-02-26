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
            'image_file' => ['filled', 'file', 'mimes:jpeg,png'],
            'image_name' => ['required', Rule::unique('images')->ignore($this->image), 'max:50', 'regex:/^[-_a-z0-9]{0,50}$/'],
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

    /**
     * ファイル名(image_name)の未入力時、画像ファイルのファイル名を、FormRequestのインスタンスとRequestのインスタンスに入力。
     */
    public function prepareForValidation(): void
    {
        if (isset($this['image_file']) && empty($this['image_name'])) {
            $image_name = \rtrim($this->image_file->getClientOriginalName(), '.' . $this->image_file->getClientOriginalExtension());
            $this['image_name'] = $image_name;
            request()->merge(\compact('image_name'));
        }
    }

    /**
     * validated()をOverride。画像ファイルのs3へのアップロード、ファイル名変更処理まで行う。
     *
     * @return object バリデータ
     */
    public function validated()
    {
        $validatedData = parent::validated();

        if (isset($validatedData['image_file'])) {
            $validatedData['image_extension'] = $validatedData['image_file']->getClientOriginalExtension();
            $validatedData['file_name'] = $validatedData['image_name'] . '.' . $validatedData['image_extension'];
            Storage::disk('s3')->putFileAs('/img', $validatedData['image_file'], $validatedData['file_name'], 'public');
            $validatedData['path'] = Storage::disk('s3')->url('img/' . $validatedData['file_name']);
        } else {
            $old_file = $this->image->file_name;
            $new_file = $validatedData['image_name'] . '.' . $this->image->image_extension;
            Storage::disk('s3')->move('img/' . $old_file, 'img/' . $new_file);
            $validatedData['path'] = Storage::disk('s3')->url('img/' . $new_file);
            $validatedData['file_name'] = $new_file;
        }

        return $validatedData;
    }
}
