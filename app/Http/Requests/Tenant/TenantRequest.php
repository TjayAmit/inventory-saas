<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'logo' => 'required|string|max:255',
            'favicon' => 'required|string|max:255',
            'timezone' => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ];
    }
}
