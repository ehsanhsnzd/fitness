<?php


namespace Core\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{
    use HasRoles;
    protected $fillable=['parent_id','title','public','photo','description'];

    /** recursive category children
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nodes()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function plan()
    {
        return $this->belongsToMany(CategoryPlan::class,'category_plan','category_id','plan_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class,'category_id','id');
    }
}
