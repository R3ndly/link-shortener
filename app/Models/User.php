<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'email',
        'password',
        'gender_id'
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime'
        ];
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function links()
    {
        return $this->hasMany(Link::class, 'user_id');
    }
}
