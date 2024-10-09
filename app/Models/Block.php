<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = 
        ['block_id',
        'name'];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_block');
    }

    public function students()
    {
        return $this->hasMany(User::class);
    }

}
