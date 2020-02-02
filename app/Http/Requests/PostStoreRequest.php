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
            'for_subscriber'  => ['required', 'boolean'],
            'post_title'   => ['required', 'max:100'],
            'post_content' => [],
            'post_excerpt' => ['max:200'],
            'post_name'    => ['nullable', Rule::unique('posts')->ignore($this->post), 'max:50', 'regex:/^[-_a-z0-9]{1,50}$/'],
            'category_id'  => [],
            'submit_btn'   => [],
        ];
    }

    public function attributes()
    {
        return [
            'for_subscriber'   => '公開範囲',
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

    /**
     * [validated()をOverride。公開状態の押下ボタンにより、公開ステータスと各日付のデータを投入。
     *
     * @return FormRequest $validatedData
     */
    public function validated()
    {
        $validatedData = parent::validated();

        switch ($validatedData['submit_btn']) {
            case 'draft_btn':
              $validatedData['post_drafted'] = now();
              $validatedData['post_status'] = 'drafted';
              break;
            case 'publish_btn':
              $validatedData['post_published'] = now();
              $validatedData['post_status'] = 'published';
              break;
            case 'modify_btn':
              $validatedData['post_modified'] = now();
              $validatedData['post_status'] = 'published';
              break;
            default:
              break;
        }

        return $validatedData;
    }
}
