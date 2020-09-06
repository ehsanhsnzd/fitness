<?php

namespace Member\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class UserPlan extends Authenticatable
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expire_date', 'start_date', 'plan_id','user_id'
    ];


    protected $primaryKey = ['user_id'];
    public $incrementing = false;


    protected $casts = [
        'email_verified_at' => 'datetime',
        'expire_date' => 'datetime',
        'start_date' => 'datetime',
    ];

}
