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
            'title' => 'required|string',
            'content' => 'required|string',
            'published_at' => 'required|date_format:Y-m-d',
            'category_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|file',
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'profile_id' => auth()->user()->profile->id,
            'image_path' => $this->image ? Storage::disk('public')->put('/images', $this->image) : null,
        ]);

        //another approach
//        if ($this->hasFile('image')) {
//            $this->merge([
//                'image_path' => Storage::disk('public')->put('/images', $this->image)
//            ]);
//        }
    }
}
