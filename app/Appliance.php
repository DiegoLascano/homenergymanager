<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appliance extends Model
{
    protected $guarded = ['id'];

    /**
    * Relation between an appliance and a user 
    *
    */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
