<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

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
            'post.title' => 'required|string',
            'post.content' => 'required|string',
            'post.published_at' => 'required|date_format:Y-m-d',
            'post.category_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|file',
            'tags' => 'nullable|string',
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'post' => [
                ...$this->validated()['post'] ?? [],
                'profile_id' => auth()->user()->profile->id,
            ],
            'image_path' => $this->image ? Storage::disk('public')->put('/images', $this->image) : null,
        ]);
    }
}
