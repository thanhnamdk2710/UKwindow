<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch ($this->method()){
            case 'POST':
                return [
                    'username' => 'required|string|unique:users,username',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:6',
                    're_password' => 'required|same:password',
                ];

            case 'PUT':
            case 'PATCH':
                return [
                    'username' => 'required|string',
                    'email' => 'required|email',
                    'password' => 'required|min:6',
                    're_password' => 'required|same:password',
                ];
        }

    }

    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập tài khoản.',
            'username.string' => 'Tài khoản phải là một chuỗi ký tự.',
            'username.unique' => 'Tài khoản đã tồn tại.',
            'email.required' => 'Vui lòng nhập địa chỉ E-Mail.',
            'email.email' => 'E-Mail không đúng định dạng.',
            'email.unique' => 'E-Mail đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            're_password.required' => 'Vui lòng xác nhận mật khẩu.',
            're_password.same' => 'Xác nhận mật khẩu không đúng.',
        ];
    }
}
