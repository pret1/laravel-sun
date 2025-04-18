<?php
declare(strict_types=1);

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

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
//        dd($this->all());
//        dd($this->tags);
        return [
            'post.title' => 'required|string',
            'post.content' => 'required|string',
            'post.published_at' => 'required|date_format:Y-m-d H:i:s',
            'post.category_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|file',
            'tags' => 'required|string',
        ];
    }

    protected function passedValidation(): void
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
