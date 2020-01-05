<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostStoreRequest extends FormRequest
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
            'post_title'   => ['required', 'max:100'],
            'post_content' => [],
            'post_excerpt' => ['max:200'],
            'post_name'    => ['nullable', Rule::unique('posts')->ignore($this->post), 'max:50', 'regex:/^[-_a-z0-9]{1,50}$/'],
        ];
    }

    public function attributes()
    {
        return [
            'post_title'   => '記事のタイトル',
            'post_content' => '記事の本文',
            'post_excerpt' => '要約文',
            'post_name'    => '投稿スラッグ',
        ];
    }

    public function messages()
    {
        return [
            'post_name.regex' => '投稿スラッグは「数字、英字(小文字)、-（ハイフン）、_（アンダーバー）」で入力して下さい。',
        ];
    }
}
