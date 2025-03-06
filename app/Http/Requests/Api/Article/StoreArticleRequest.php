<?php

namespace App\Http\Requests\Api\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title' => "required|string",
            'content' => "required|string",
            'is_published' => "required|boolean",
            'published_at' => "required|date",
            'category_id' => "required|exists:categories,id",
            'profile_id' => "required|exists:profiles,id",
        ];
    }
}
