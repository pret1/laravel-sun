<?php
declare (strict_types=1);

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
            'images' => 'nullable|array',
            'tags' => 'nullable|string',
        ];
    }

    protected function passedValidation(): void
    {
        $imagePaths = [];

        if ($this->hasFile('images')) {
            foreach ($this->file('images') as $image) {
                $path = Storage::disk('public')->putFile('/images', $image);
                $imagePaths[] = $path;
            }
        }

        $this->merge([
            'post' => [
                ...$this->validated()['post'] ?? [],
                'profile_id' => auth()->user()->profile->id,
            ],
            'image_paths' => $imagePaths,
        ]);
    }
}
