<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all authenticated users to store students
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
            'admission_number' => 'required|string|max:255|unique:students,admission_number',
            'date_of_birth' => 'nullable|date',
            'school_classes' => 'required|array',
            'school_classes.*' => 'required|exists:school_classes,id',
        ];
    }
}
