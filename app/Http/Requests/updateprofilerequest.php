<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateprofilerequestcontroller extends FormRequest
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
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'email' => 'required|email|max:255|unique:profiles,email,' . $this->route('profile'),
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'bio' => 'nullable|string|max:500',
        ];
    }
}
