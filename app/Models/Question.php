<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'order',
        'path',
        'quiz_id',
        'questiontype_id',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }
    public function questiontype()
    {
        return $this->belongsTo(QuestionType::class, 'questiontype_id', 'id');
    }
    public function answers()
    {
        return $this->hasMany(UserQuestion::class, 'question_id', 'id');
    }
}
