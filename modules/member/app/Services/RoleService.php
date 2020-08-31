<?php


namespace Member\app\Services;



use Carbon\Carbon;
use Core\app\repositories\PlanRepository;
use Core\app\repositories\RoleRepository;
use Core\app\Services\SettingService;
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

    public function __construct($repo= null)
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
            ->with('categories')
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

        $plan = $this->repo->find($request['plan_id']);
        $freeDays = $this->setting->name('free_days');
        $user = $this->user;
        $user->expire_date = Carbon::now()->addDays($freeDays);
        $user->start_date = Carbon::now();
        $user->save();

        return [
            $user->assignRole($plan->role()->first()->id)
        ];
    }

}
