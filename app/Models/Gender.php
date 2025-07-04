<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'gender';
    protected $primaryKey = 'gender_id';
    public $timestamps = false;

    protected $fillable = [
        'gender_name'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'gender_id');
    }
}
