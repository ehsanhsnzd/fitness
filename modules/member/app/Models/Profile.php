<?php

namespace Member\app\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Profile extends Authenticatable
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name'
    ];


}
