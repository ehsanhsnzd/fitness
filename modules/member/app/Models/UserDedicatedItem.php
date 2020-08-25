<?php


namespace Member\app\Models;


use Core\app\Models\Item;
use Illuminate\Database\Eloquent\Model;

class UserDedicatedItem extends Model
{
    protected $fillable = ['plan_id','day_id','item_id','item_info_id'];

    public function item()
    {
        return $this->hasOne(Item::class,'id','item_id');
    }

    public function itemInfo()
    {
        return $this->hasOne(Item::class,'id','item_id');
    }
}
