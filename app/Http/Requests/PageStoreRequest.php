<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageStoreRequest extends FormRequest
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
            'page_title'        => ['required', 'max:100'],
            'page_content'      => [],
            'page_name'         => ['required', Rule::unique('pages')->ignore($this->page), 'max:50', 'regex:/^[-_a-z0-9]{1,50}$/'],
            'page_status'       => [],
        ];
    }

    public function attributes()
    {
        return [
            'page_title'        => '固定ページのタイトル',
            'page_content'      => '固定ページの本文',
            'page_name'         => '固定ページのスラッグ',
        ];
    }

    public function messages()
    {
        return [
            'page_name.regex'      => '固定ページのスラッグは「数字、英字(小文字)、-（ハイフン）、_（アンダーバー）」で入力して下さい。',
        ];
    }
}
