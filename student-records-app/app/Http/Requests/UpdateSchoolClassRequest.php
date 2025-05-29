<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolClassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all authenticated users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $schoolClassId = $this->route('school_class') ? $this->route('school_class')->id : null;
        // Unique checks for name might be needed depending on requirements, e.g., unique within a grade level.
        // For simplicity, not adding complex unique checks here.
        return [
            'name' => 'required|string|max:255',
            'grade_level' => 'required|string|max:50',
            'section' => 'nullable|string|max:50',
            'teachers' => 'nullable|array',
            'teachers.*' => 'exists:users,id', // Ensure each teacher ID exists in the users table
        ];
    }
}
