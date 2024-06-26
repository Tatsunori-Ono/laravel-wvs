<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * リクエストに適用されるバリデーションルールを取得します。
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // 名前は必須で、文字列で、最大255文字
            'name' => ['required', 'string', 'max:255'],
            // メールアドレスは必須で、小文字の文字列で、メール形式で、最大255文字
            // 現在のユーザーIDを無視して一意であることを確認
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            // 画像ファイルは任意で、ファイルであり、指定されたMIMEタイプのいずれかで、最大3MB
            'picture' => ['file', 'mimes:gif,png,jpg,webp', 'max:3072'],
            // Google 2FAの有効化は任意で、ブール値
            'is_enable_google2fa' => ['nullable', 'boolean'],
        ];
    }
}
