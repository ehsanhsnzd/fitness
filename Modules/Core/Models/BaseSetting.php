<?php


namespace Core\Models;


use Illuminate\Database\Eloquent\Model;

class BaseSetting extends Model
{
    protected $fillable=['title','slug','parent_id'];

    /** return children
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nodes()
    {
        return $this->hasMany(BaseSetting::class,'parent_id','id');
    }


    /** return all settings
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings()
    {
        return $this->hasMany(Setting::class,'base_setting_id','id');
    }

}
