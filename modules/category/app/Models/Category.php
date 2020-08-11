<?php


namespace Category\app\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{
    use HasRoles;
    protected $fillable=['title'];

    /** recursive category children
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nodes()
    {
        return $this->hasMany(Category::class,'parent_id','id')
            ->with('nodes');
    }

}
