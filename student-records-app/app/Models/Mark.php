<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Models\SchoolClass;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 
        'subject_id', 
        'user_id', 
        'school_class_id', 
        'marks_obtained', 
        'total_marks', 
        'assessment_type', 
        'date_of_assessment', 
        'comments'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function user() // Represents the teacher who recorded the mark
    {
        return $this->belongsTo(User::class);
    }

    public function teacher() // Alias for user() for clarity in context
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
