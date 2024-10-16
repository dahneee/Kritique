<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'teacher_id', 'subject_id'];

    public function student() {
        return $this->belongsTo(User::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
