<?php


namespace Member\app\Services;



use Carbon\Carbon;
use Core\app\Models\Plan;
use Core\app\repositories\RoleRepository;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class RoleService
{
    /**
     * @var RoleRepository
     */
    private $repo;
    private $user;

    public function __construct($repo= null)
    {
        $this->repo = $repo ?? new Plan();
        $this->user = auth()->guard('users-api')->user();
    }

    public function all()
    {
        return $this->user->load('plan.categories')->toArray();
    }

    public function get($request)
    {
        return $this->repo->find($request->id)->toArray();
    }

    /** assign new plan
     * @param $request
     * @return array
     */
    public function register($request)
    {
        $selected =$this->user->selectedPlans();
        $plan = $this->repo->find($request['plan_id']);

        /** if registered before  */
        $active = $selected->get()->find($plan->role_id)->active ?? false;
        if($selected->get()->find($plan->role_id) && !$active)
            throw new AccessDeniedException('registered once before');

        //TODO add from settings
        $user = $this->user;
        $user->start_date = Carbon::now();
        $user->expire_date = Carbon::now()->addDays(2)->timestamp;
        $user->plan_id = $plan->id;
        $user->save();

        $selected->where('active',false)->pluck('name')->map(function ($key) use ($user){
            $user->removeRole($key);
        });
        $selected->syncWithoutDetaching($plan->role_id);

        return [
            $user->assignRole($plan->role()->first()->name)
        ];
    }

}
