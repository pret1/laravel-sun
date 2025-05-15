<?php

namespace App\Http\Requests\Client\Chat\Group;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupeRequest extends FormRequest
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
            'profile_ids' => 'required|array|min:1',
            'profile_ids.*' => 'exists:profiles,id',
        ];
    }
}
