<?php


namespace Member\app\Services;


use Core\app\Services\BaseService;
use Member\app\Models\UserDedicatedPlan;

class DedicatedPlanService extends BaseService
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    public function __construct($model = NULL){
        $this->user = auth()->guard('users-api')->user();
        parent::__construct($model);
    }

    public function get($request)
    {
//        return $this->repo->fetch($request->id,['items.item,itemInfo']);
        return (new UserDedicatedPlan())->find(1)
            ->items()->with('item','itemInfo')
            ->get()->toArray();
    }

    public function set($request)
    {
        return $this->user->dedicatedPlan()->create($request)->toArray();
    }

}
