<?php


namespace Core\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class ItemsFiles extends Model
{
    protected $fillable=['file'];

    protected $hidden =[];
}
