<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEnvironment extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
    ];
}
