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
    ];
    protected $primaryKey = 'subject_id'; 
    public $incrementing = false;
    
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subject', 'subject_id', 'teacher_id');
    }
}
