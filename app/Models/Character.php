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
        'path'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'institute_id', 'id');
    }
}
