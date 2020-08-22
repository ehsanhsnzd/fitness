<?php


namespace Member\app\Services;


use Core\app\Services\BaseService;

class PersonalPlanService extends BaseService
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
        return $this->repo->fetch($request->id,['items'])->toArray();
    }

    public function set($request)
    {
        return $this->user->personalPlan()->create($request)->toArray();
    }

}
