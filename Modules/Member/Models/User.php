<?php

namespace Member\Models;

use Core\Models\Plan;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Symfony\Component\Finder\Exception\AccessDeniedException;


class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','expire_date','start_date'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'expire_date' => 'datetime',
    ];

/*    /** permission for plan expire date
     * @param iterable|string $abilities
     * @param array $arguments
     * @return bool
     * @throws AccessDeniedException
     */

/*
    public function can($abilities, $arguments = [])
    {
        if($this->expire_date<= now() || $this->expire_date == null)
            throw new AccessDeniedException('dont have any plan');

        return parent::can($abilities,$arguments);
    }*/

    public function selectedRoles()
    {
        return $this->belongsToMany(Role::class,'selected_roles','user_id','role_id')
            ->withPivot('active');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id','id');
    }

    public function findForPassport($username)
    {
        return $this->where('mobile', $username)->first();
    }

    public function dedicatedPlan()
    {
        return $this->hasMany(UserDedicatedPlan::class,'user_id','id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class,'user_id','id');
    }

}
