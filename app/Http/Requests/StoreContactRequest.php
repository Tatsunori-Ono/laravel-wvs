<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * このリクエストが認可されているかどうかを判断します。
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * リクエストに適用されるバリデーションルールを取得します。
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 名前は必須で、文字列で、最大20文字
            'name' => ['required', 'string', 'max:20'],
            // メールアドレスは必須で、メール形式で、最大255文字
            'email' => ['required', 'email', 'max:255'],
            // ウォーリック生・非ウォーリック生の選択は必須で、ブール値
            'non_warwick_student' => ['required', 'boolean'],
            // 件名は必須で、文字列で、最大50文字
            'subject' => ['required', 'string', 'max:50'],
            // 問い合わせ内容は必須で、文字列で、最大200文字
            'contact' => ['required', 'string', 'max:200'],
            // 注意事項の同意は必須で、受け入れられていること
            'caution' => ['required', 'accepted'],
        ];
    }
}
