<?php namespace Core\app\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use Member\app\Models\Trainer;

class CategoryPolicy
{
    use HandlesAuthorization;

    /** User can get category
     * @param Trainer $user
     * @return bool
     */
    public function getCategory(Trainer $user)
    {
//        return $user->can('category_'.$this->id);
    }

}
