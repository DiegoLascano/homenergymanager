<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * Relation between a user and appliances
    *
    */
    public function appliances()
    {
        return $this->hasMany(Appliance::class, 'owner_id');
    }

    /**
    * Relation between a user and his schedules
    *
    */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'owner_id');
    }
}
