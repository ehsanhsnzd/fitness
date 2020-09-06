<?php namespace Core\Policies;


use Carbon\Carbon;
use Core\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;
use Member\Models\User;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class CategoryPolicy
{
    use HandlesAuthorization;

    /** User can get category
     * @param User|null $user
     * @param Category $category
     * @return bool
     */
    public function getCategory(?User $user,Category $category)
    {
        if(isset($category) && $category->public)
            return true;

        if (($user->expire_date!=null && $user->expire_date<= Carbon::now()) ||
            !$user->can('category.'.$category->id))
            throw new AccessDeniedException('dont have access');

        return true;
    }

}
