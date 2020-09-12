<?php


namespace Core\Models;


use Illuminate\Database\Eloquent\Model;
use Member\Models\ItemInfo;
use Spatie\Permission\Models\Role;

class Item extends Model
{
    protected $fillable=['title','photo','attached','description','category_id'];


    public function files()
    {
        return $this->hasMany(ItemsFiles::class,'item_id','id');
    }

    public function itemInfo()
    {
        return $this->hasOne(ItemInfo::class,'item_id','id');
    }
}
