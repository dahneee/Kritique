<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['questionnaire_id', 'question_id', 'answer', 'subject_id']; 

    public function questionnaire() {
        return $this->belongsTo(Questionnaire::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
