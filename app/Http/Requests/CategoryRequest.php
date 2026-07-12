<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $category = $this->route('category');

        return [
            // ✨ ISININGIT NATIN ANG string AT max:255 SA LOOB NG IYONG ARRAY RULES BRO:
            'category_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category),
            ],
        ];
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
        // 🔒 AKURADONG INIWAN AT HINDI GINALAW ANG MGA CUSTOM MESSAGES MO BRO:
        return [
            'category_name.required' => 'Category Name is required.',
            'category_name.unique'   => 'This Category Name already exists.', // Pasadyang mensahe para sa duplicate
        ];
    }
}
