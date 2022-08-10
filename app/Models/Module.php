<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'order',
        'path',
        'price',
        'color_hex',
    ];

    public function users()
    {
        return $this->hasMany(UserModule::class, 'module_id', 'id');
    }
    public function characters()
    {
        return $this->hasMany(Character::class, 'module_id', 'id');
    }
}
