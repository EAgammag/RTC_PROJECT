<?php

namespace App\Http\Requests\Cadet;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CadetInfoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isCadet() ?? false;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Personal
            'date_of_birth'          => ['nullable', 'date', 'before:today'],
            'gender'                 => ['nullable', 'string', 'in:Male,Female'],
            'blood_type'             => ['nullable', 'string', 'max:10'],
            'religion'               => ['nullable', 'string', 'max:100'],
            'contact_number'         => ['nullable', 'string', 'max:20'],
            // Academic
            'course_year'            => ['nullable', 'string', 'max:100'],
            // Physical
            'height'                 => ['nullable', 'string', 'max:20'],
            'weight'                 => ['nullable', 'string', 'max:20'],
            // Address
            'address'                => ['nullable', 'string', 'max:500'],
            // Emergency contact
            'emergency_name'         => ['nullable', 'string', 'max:255'],
            'emergency_relationship' => ['nullable', 'string', 'max:100'],
            'emergency_contact'      => ['nullable', 'string', 'max:20'],
        ];
    }
}
