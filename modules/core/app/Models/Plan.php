<?php


namespace Core\app\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Plan extends Model
{
    protected $fillable=['title','description','expire_days','role_id','group'];


    public function role()
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class,'plan_id','id');
    }
}
