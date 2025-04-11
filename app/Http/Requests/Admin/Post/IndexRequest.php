<?php
declare(strict_types=1);

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'title' => 'nullable|string',
            'content' => 'nullable|string',
//            'category_id' => 'nullable|integer',
            'category_title' => 'nullable|string',
            'published_at_from' => 'nullable|date',
            'published_at_to' => 'nullable|date',
            'profile_id' => 'nullable|integer',
            'tag_title' => 'nullable|string',
            'likes_from' => 'nullable|integer',
            'likes_to' => 'nullable|integer',
            'views_from' => 'nullable|integer',
            'views_to' => 'nullable|integer',
            'liked_by_profile' => 'nullable|integer',
            'is_published' => 'nullable|boolean',
            'tags' => 'nullable|string',
            'per_page' => 'nullable|integer',
            'page' => 'nullable|integer',
        ];
    }

    public function passedValidation(): void
    {
        $this->merge([
            'per_page' => $this->per_page ?? 5,
            'page' => $this->page ?? 1,
        ]);
    }
}


