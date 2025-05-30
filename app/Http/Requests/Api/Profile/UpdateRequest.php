<?php

namespace App\Http\Requests\Api\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => 'required|string|unique:profiles,phone,' . $this->profile->id,
            'address' => 'required|string',
            'gender' => 'required|string|in:male,female,other',
        ];
    }
}
