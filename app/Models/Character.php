<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'order',
        'path',
        'module_id'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'character_id', 'id');
    }
}
