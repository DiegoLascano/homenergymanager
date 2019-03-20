<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = ['id'];

    /**
    * Relation between a schedule and its owner
    *
    */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
