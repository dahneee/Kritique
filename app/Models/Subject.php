<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'subject_name',
        'department',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department', 'department_id'); 
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher', 'subject_id', 'teacher_id');
    }
}
