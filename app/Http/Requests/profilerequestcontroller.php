<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class profilerequestcontroller extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'email' => [ 'required','email','max :255',
            ],
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date|before_or_equal:-18 years',
            'bio' => 'nullable|string|max:500'
        ];
    }



    public function messages()
    {
        return [
            'email.unique' => 'This email is already registered',
            'date_of_birth.before_or_equal' => 'You must be at least 18 years old'
        ];
    }
}
