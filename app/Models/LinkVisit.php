<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkVisit extends Model
{
    protected $primaryKey = 'visit_id';

    protected $fillable = ['link_id', 'count_transition', 'transition'];

    public $timestamps = false;

    public function link()
    {
        return $this->belongsTo(Link::class, 'link_id');
    }
}
