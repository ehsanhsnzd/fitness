<?php


namespace Member\Services;


use Carbon\Carbon;
use Core\repositories\PlanRepository;
use Core\repositories\RoleRepository;
use Core\Services\SettingService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class RoleService
{
    /**
     * @var RoleRepository
     */
    private $repo;
    private $user;
    private $setting;

    public function __construct($repo = null)
    {
        $this->repo = $repo ?? new PlanRepository();
        $this->setting = new SettingService();
        $this->user = auth()->guard('users-api')->user();
    }

    public function all()
    {
        return
            $this->repo->all()->toArray();
    }

    public function current()
    {
        return $this->user->plan()
            ->get()
            ->toArray();
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
//        $selected =$this->user->selectedRoles();
        /** if registered before  */
//        $active = $selected->where([
//                'role_id'   => $plan->role_id
//            ])->first()
//              ->pivot->active ?? false;
//
//
//        if($selected->get()->find($plan->role_id) && !$active)
//            throw new AccessDeniedException('registered once before');

        /** add from settings */

//        DB::table('user_plans')->updateOrInsert([
//            'user_id'       => $this->user->id,
//            'plan_group'       => $plan->group,
//        ],[
//            'user_id'       => $user->id,
//            'plan_id'       => $plan->id,
//            'start_date'    => Carbon::now(),
//            'expire_date'   => Carbon::now()->addDays((int)$freeDays),
//            'plan_group'    => $plan->group
//        ]);

//        /** remove all roles */
//        $selected->wherePivot('active',true)->pluck('name')->map(function ($key) use ($user){
//            $user->removeRole($key);
//        });
//
//        /** assign roles */
//        $selected->syncWithoutDetaching($plan->role_id);

//        $freeDays = $this->setting->name('free_days');
//        $user->expire_date = Carbon::now()->addDays($freeDays);

        return [
            $this->assignPlan($this->user,$request['plan_id'])
        ];

    }

    public function assignPlan($user, $planId)
    {
        $plan = $this->repo->find($planId);
        $user->start_date = Carbon::now();

        if ($plan->expire_days > 0)
            $user->expire_date = Carbon::now()->addDays($plan->expire_days);

        if($user->plan()->first())
            $user->removeRole($user->plan()->first()->role()->first()->id);

        $user->plan_id = $planId;
        $user->save();
        $user->assignRole($plan->role()->first()->id);
        return $plan;

    }

}
