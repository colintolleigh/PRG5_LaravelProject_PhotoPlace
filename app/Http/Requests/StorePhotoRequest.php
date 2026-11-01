<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_visible' => $this->boolean('is_visible'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:30720'],
            'location' => ['nullable', 'string', 'max:255'],
            'camera' => ['nullable', 'string', 'max:255'],
            'lens' => ['nullable', 'string', 'max:255'],
            'focal_length' => ['nullable', 'string', 'max:50'],
            'aperture' => ['nullable', 'string', 'max:50'],
            'shutter_speed' => ['nullable', 'string', 'max:50'],
            'iso' => ['nullable', 'integer', 'min:1', 'max:1000000'],
            'taken_at' => ['nullable', 'date', 'before_or_equal:today'],
            'is_visible' => ['boolean'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['integer', 'exists:'.Category::class.',id'],
        ];
    }
}
