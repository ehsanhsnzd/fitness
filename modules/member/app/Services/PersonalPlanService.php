<?php


namespace Member\app\Services;



use Core\app\repositories\BaseRepository;

class PersonalPlanService
{
    /**
    * @var mixed|null
    */
    private $repo;
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    public function __construct($model = NULL){
        $this->repo = new BaseRepository($model);
        $this->user = auth()->guard('users-api')->user();
    }

    public function get($request)
    {
        return $this->repo->fetch($request->id,['items'])->toArray();
    }

    public function set($request)
    {
        return $this->user->personalPlan()->create($request)->toArray();
    }

    public function edit($request)
    {
        return [
            $this->repo->update($request['id'],$request)
        ];
    }

    public function delete($request)
    {
        $this->repo->delete($request['id']);
    }
}
