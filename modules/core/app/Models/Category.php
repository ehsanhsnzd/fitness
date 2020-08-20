<?php


namespace Core\app\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{
    use HasRoles;
    protected $fillable=['parent_id','title','plan_id','public'];

    /** recursive category children
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nodes()
    {
        return $this->hasMany(Category::class,'parent_id','id')
            ->with('nodes');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class,'plan_id','id');
    }

    public function items()
    {
        return $this->hasMany(Item::class,'category_id','id');
    }
}
