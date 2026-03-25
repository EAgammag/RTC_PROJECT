<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Authorization is already enforced by the role:admin middleware.
     */
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, array<int, string>> */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'student_id' => ['required', 'string', 'max:50', 'unique:users,student_id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'string',
                'min:12',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
            ],
            'role' => ['required', 'in:admin,officer,cadet'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'password.regex' => 'Password must contain uppercase, lowercase, a number, and a special character.',
        ];
    }
}
