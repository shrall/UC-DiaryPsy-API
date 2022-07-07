<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'address',
        'phone',
        'year_born',
        'institute_id',
        'religion_id',
        'tribe_id',
        'city_id',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function city()
    {
        return $this->belongsTo(Regency::class, 'city_id', 'id');
    }
    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id', 'id');
    }
    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id', 'id');
    }
    public function tribe()
    {
        return $this->belongsTo(Tribe::class, 'tribe_id', 'id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function modules()
    {
        return $this->hasMany(Module::class, 'user_id', 'id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'user_id', 'id');
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'user_id', 'id');
    }
}
