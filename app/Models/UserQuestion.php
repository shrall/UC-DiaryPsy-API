<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'choice',
        'answer',
        'open_question',
        'status',
        'user_id',
        'question_id',
        'quiz_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
