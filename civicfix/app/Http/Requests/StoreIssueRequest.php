<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIssueRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Roads,Lighting,Waste,Water,Other',
            'description' => 'required|string|max:1000',
            'address' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Please provide a title for the issue.',
            'category.required' => 'You must select a category for the issue.',
            'category.in' => 'The selected category is invalid.',
            'description.required' => 'Please describe the issue in detail.',
            'description.max' => 'The description cannot exceed 1000 characters.',
        ];
    }
}
