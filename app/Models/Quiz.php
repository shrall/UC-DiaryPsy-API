<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'order',
        'path',
        'character_id',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id', 'id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }
    public function users()
    {
        return $this->hasMany(UserQuiz::class, 'quiz_id', 'id');
    }
}
