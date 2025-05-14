<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'text' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4|max:2048',
            'receive_user_id' => 'required|exists:users,id',
        ];
    }

    /**
     * attributes
     * フィールド名を日本語に変換
     */
    public function attributes(): array
    {
        return [
            'text' => 'メッセージ',
            'file_path' => 'ファイル',
            'receive_user_id' => '受信者',
        ];
    }

    /**
     * エラーメッセージ
     */
    public function messages(): array
    {
        return [
            'required' => ':attributeは必須です。',
            'string' => ':attributeは文字列でなければなりません。',
            'max' => ':attributeは:max文字以内でなければなりません。',
            'file' => ':attributeはファイルでなければなりません。',
            'mimes' => ':attributeは:valuesのいずれかの形式でなければなりません。',
            'exists' => ':attributeは存在しないユーザーです。',
        ];
    }
}
