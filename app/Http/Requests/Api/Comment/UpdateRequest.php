<?php

namespace App\Http\Requests\Api\Comment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string',
            'status' => 'required|boolean',
            'parent' => 'required|string',
            'like' => 'required|integer',
        ];
    }
}
