<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storetaskrequest extends FormRequest
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
            'description' => 'nullable|string',
            'priority' => 'required|integer|in:1,2,3', // Assuming 1=Low, 2=Medium, 3=High
            'profile_id' => 'nullable|exists:profiles,id',
            'categorie_id' => 'nullable|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
        ];
    }
}
