<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:11|integer'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập ',
            'email' => ':attribute dạng email',
            'integer' => ':attribute phải là dạng số',
            'min' => ':attribute không nhỏ hơn 11 chữ số'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên người dùng',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Confirm Password',
            'phone' => 'Số điện thoại',
            'adress'=> 'Địa chỉ'
        ];
    }
}
