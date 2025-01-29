<?php

namespace App\Http\Requests\Api\Post;

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
            'title' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string',
            'is_published' => 'required|boolean',
            'likes' => 'required|integer',
            'image_path' => 'required|string|unique:posts,image_path,' . $this->post->id,
            'tag' => 'required|string',
            'category' => 'required|string',
            'views' => 'required|integer',
            'published_at' => 'required|date_format:Y-m-d',
        ];
    }
}
