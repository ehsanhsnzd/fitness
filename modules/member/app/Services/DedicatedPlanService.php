<?php


namespace Member\app\Services;


use Core\app\Services\BaseService;
use Member\app\Repositories\DedicatedPlanRepository;

class DedicatedPlanService extends BaseService
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    public function __construct($repo = NULL){
        $this->user = auth()->guard('users-api')->user();
        $this->repo = $repo ?? new DedicatedPlanRepository();
    }

    public function get($request)
    {
        return  $this->repo->find($request['id'])
            ->items($request['id'])->with('item','itemInfo')
            ->get()
            ->toArray();
    }

    public function getDays($request)
    {
        return $this->repo->fetch($request['id'],['days'])->toArray();
    }

    public function set($request)
    {
        return $this->user->dedicatedPlan()->create($request)->toArray();
    }

}
