<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SchoolClass; // Added

class StoreMarkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!$this->user() || !$this->input('school_class_id')) {
            return false;
        }
        $schoolClass = SchoolClass::find($this->input('school_class_id'));
        if (!$schoolClass) {
            return false;
        }
        // Check if the authenticated user is associated with the school class
        return $this->user()->schoolClasses()->where('school_classes.id', $schoolClass->id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'school_class_id' => 'required|exists:school_classes,id',
            'marks_obtained' => 'required|numeric|min:0',
            'total_marks' => 'nullable|numeric|min:0|gte:marks_obtained',
            'assessment_type' => 'required|string|max:100',
            'date_of_assessment' => 'required|date',
            'comments' => 'nullable|string',
        ];
    }
}
