<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mark;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'subject_code'];

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
