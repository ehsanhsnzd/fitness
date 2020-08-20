<?php namespace Core\app\Policies;


use Carbon\Carbon;
use Core\app\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;
use Member\app\Models\User;
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

        $plan = $category->plan()->first();
        if ($user->plan($plan->group)->first()->pivot->expire_date<= Carbon::now() ||
            !$user->can('category.'.$category->id))
            throw new AccessDeniedException('dont have access');

        return true;
    }

}
