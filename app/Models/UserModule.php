<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModule extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'user_id',
        'module_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }
}
