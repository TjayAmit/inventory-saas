<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'ext_name' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => "required|string|min:8"
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => "Please provide a last name.",
            'first_name.required' => "Please provide a first name.",
            'email.required' => 'Please provide an email.',
            'email.email' => 'The email address must be a valid format.',
            'email.unique' => 'This email address is already registered.'
        ];   
    }
}
