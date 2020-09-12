<?php


namespace Member\Models;


use Core\Models\Category;
use Illuminate\Database\Eloquent\Model;

class UserDedicatedPlan extends Model
{

    protected $fillable = ['user_id','title','age','weight','height'];


    public function days()
    {
        return $this->hasMany(UserDedicatedItem::class,'plan_id','id');
    }


    public function items($day)
    {
        return $this->hasMany(UserDedicatedItem::class,'plan_id','id')
            ->where(['day_id'=>$day]);
    }


}
