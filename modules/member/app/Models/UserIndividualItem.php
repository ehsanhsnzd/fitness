<?php


namespace Member\app\Models;


use Illuminate\Database\Eloquent\Model;

class UserIndividualItem extends Model
{
    protected $fillable = ['title','plan_id','value'];
}
