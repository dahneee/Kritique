<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 
        'teacher_first_name', 
        'teacher_middle_name', 
        'teacher_last_name', 
        'department',
];

    

    
        protected $casts = [
            'email_verified_at' => 'datetime',
            
        ];
        

    public function department()
    {
        return $this->belongsTo(Department::class, 'department', 'department_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject', 'teacher_id', 'subject_id');
    }

    public function blocks()
    {
        return $this->belongsToMany(Block::class, 'teacher_block', 'teacher_id', 'block_id');
    }

    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
