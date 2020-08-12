<?php namespace Core\app\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use Member\app\Models\User;

class CategoryPolicy
{
    use HandlesAuthorization;

    /** User can get category
     * @param User $user
     * @return bool
     */
    public function getCategory(User $user)
    {
//        return $user->can('category_'.$this->id);
    }

}
