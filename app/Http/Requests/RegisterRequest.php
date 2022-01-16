<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => ['required', 'string', 'unique:users', 'regex:/^[A-Za-z][A-Za-z0-9_]*$/u'],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => __('auth.username.required'),
            'username.unique' => __('auth.username.unique'),
            'username.regex' => __('auth.username.regex'),
            'email.required' => __('auth.email.required'),
            'email.email' => __('auth.email.email'),
            'email.unique' => __('auth.email.unique'),
            'password.required' => __('auth.password.required'),
            'password.min' => __('auth.password.min'),
        ];
    }
}
