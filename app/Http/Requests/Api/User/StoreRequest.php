<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'login' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'email_verified_at' => 'nullable|date_format:Y-m-d',
            'password' => 'required|string',
            'remember_token' => 'nullable|string',
            'role' => 'required|string',
        ];
    }
}
