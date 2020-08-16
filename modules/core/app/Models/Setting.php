<?php


namespace Core\app\Models;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable=['title','value','slug','parent_id'];

    /** return children
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nodes()
    {
        return $this->hasMany(BaseSetting::class,'parent_id','id');
    }

}
