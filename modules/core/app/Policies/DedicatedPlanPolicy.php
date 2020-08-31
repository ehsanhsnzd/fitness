<?php namespace Core\app\Policies;


use Carbon\Carbon;
use Core\app\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;
use Member\app\Models\User;
use Member\app\Models\UserDedicatedPlan;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class DedicatedPlanPolicy
{
    use HandlesAuthorization;

    /** User can get category
     * @param User|null $user
     * @param UserDedicatedPlan $dedicatedPlan
     * @return bool
     */
    public function getDedicatedPlan(?User $user,UserDedicatedPlan $dedicatedPlan)
    {
        return $user->id==$dedicatedPlan->user_id;
    }

}
