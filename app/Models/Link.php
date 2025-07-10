<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LinkVisit;

class Link extends Model
{
    protected $primaryKey = 'link_id';
    protected $fillable = ['user_id', 'original_url', 'short_url'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function visits()
    {
        return $this->hasMany(LinkVisit::class, 'link_id');
    }
}
