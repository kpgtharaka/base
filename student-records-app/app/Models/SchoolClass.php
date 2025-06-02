<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\User;
use App\Models\Mark;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'grade_level', 'section'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'school_class_student');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'school_class_user');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
