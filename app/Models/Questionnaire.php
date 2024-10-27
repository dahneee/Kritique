<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'teacher_id', 'subject_id'];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function answers() {
        return $this->hasMany(Answer::class, 'questionnaire_id');
    }

    public function questions() {
        return $this->belongsToMany(Question::class, 'questionnaire_question', 'questionnaire_id', 'question_id');
    }
}
