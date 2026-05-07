<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueRequest extends FormRequest
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
            'title' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|in:Roads,Lighting,Waste,Water,Other',
            'description' => 'sometimes|required|string|max:1000',
            'address' => 'sometimes|nullable|string|max:255',
            'status' => 'sometimes|required|string|in:pending,investigating,in_progress,resolved,closed',
        ];
    }
}
