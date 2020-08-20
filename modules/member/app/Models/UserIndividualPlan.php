<?php


namespace Member\app\Models;


use Illuminate\Database\Eloquent\Model;

class UserIndividualPlan extends Model
{
    protected $fillable = ['title','user_id'];


    public function items()
    {
        return $this->hasMany(UserIndividualItem::class,'plan_id','id');
    }
}
