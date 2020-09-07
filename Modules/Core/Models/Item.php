<?php


namespace Core\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Item extends Model
{
    protected $fillable=['title','photo','attached','description','category_id'];


    public function files()
    {
        return $this->hasMany(ItemsFiles::class,'item_id','id');
    }
}
