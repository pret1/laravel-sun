<?php

namespace App\Http\Requests\Client\Notification;

use Illuminate\Foundation\Http\FormRequest;

class MakrReadRequest extends FormRequest
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
            'notifications' => 'required|array',
            'notifications.id*' => 'integer|exists:user_notifications,id',
        ];
    }
}
