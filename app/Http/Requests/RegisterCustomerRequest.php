<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomerRequest extends FormRequest
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
            'full_name' => [
                'required',
                'string',
                'regex:/^\S+ \S+$/',
            ],
            'email' => 'required|email|unique:users,email',
            'phone' => [
                'required',
                'unique:customers,phone',
                'regex:/^07\d{9}$/'
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'same:confirmPassword',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/'
            ],
            // 'confirmPassword' => [
            //     'required',
            // ],
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Full name required',
            'full_name.regex' => 'Full name must be in first and last name order',
            'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character',
        ];
    }
}