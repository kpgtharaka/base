<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mark;
use App\Models\SchoolClass;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date_of_birth', 'admission_number'];

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function schoolClasses()
    {
        return $this->belongsToMany(SchoolClass::class, 'school_class_student');
    }
}
