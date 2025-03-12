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
            'title' => 'nullable|string',
            'content' => 'nullable|string',
//            'author' => 'nullable|string',
            'is_published' => 'nullable|boolean',
//            'likes' => 'nullable|integer',
//            'image_path' => 'nullable|string|unique:posts,image_path,' . $this->post->id,
//            'tag' => 'nullable|string',
            'category_id' => 'nullable|integer:categories,id',
            'profile_id' => 'nullable|integer:profiles,id',
//            'views' => 'nullable|integer',
            'published_at' => 'nullable|date_format:Y-m-d',
        ];
    }
}
