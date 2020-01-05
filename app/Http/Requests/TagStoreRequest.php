<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagStoreRequest extends FormRequest
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
            'tag_title' => ['required', Rule::unique('tags')->ignore($this->tag), 'max:15'],
            'tag_name'  => ['required', Rule::unique('tags')->ignore($this->tag), 'max:50', 'regex:/^[-_a-z0-9]{1,50}$/'],
        ];
    }

    public function attributes()
    {
        return [
            'tag_title' => 'タグ名',
            'tag_name'  => 'タグスラッグ',
        ];
    }

    public function messages()
    {
        return [
            'tag_name.regex' => 'タグスラッグは「数字、英字(小文字)、-（ハイフン）、_（アンダーバー）」で入力して下さい。',
        ];
    }
}
