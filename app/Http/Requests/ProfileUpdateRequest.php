<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'gender' => ['nullable', 'in:Laki-laki,Perempuan,Lainnya'],
            'dob_day' => ['nullable', 'integer', 'between:1,31'],
            'dob_month' => ['nullable', 'integer', 'between:1,12'],
            'dob_year' => ['nullable', 'integer', 'digits:4'],
        ];
    }
}
