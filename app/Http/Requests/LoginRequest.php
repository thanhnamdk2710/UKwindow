<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập tài khoản.',
            'username.string' => 'Tài khoản phải là chuỗi ký tự.',
            'password.required' => 'Vui lòng nhập tài khoản.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
        ];
    }
}
