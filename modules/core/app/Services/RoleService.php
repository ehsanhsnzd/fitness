<?php


namespace Core\app\Services;


use Core\app\repositories\PlanRepository;
use Core\app\repositories\RoleRepository;
use Member\app\Repositories\UserRepository;

class RoleService
{
    /**
     * @var RoleRepository
     */
    private $repo;
    private $userRepo;
    private $planRepo;
    private $setting;

    public function __construct($repo = null)
    {
        $this->repo = $repo ?? new RoleRepository();
        $this->userRepo = new UserRepository();
        $this->planRepo = new PlanRepository();
        $this->setting = new SettingService();
    }

    public function all()
    {
        return $this->repo->all()->toArray();
    }

    public function get($request)
    {
        return $this->repo->find($request['id'])->toArray();
    }

    public function set($request)
    {

        $plan = $this->planRepo->create($request);
        $request['name'] = $plan->id;
        $request['guard_name'] = 'users';
        $role = $this->repo->create($request);
        $plan->role_id = $role->id;
        $plan->save();

        if($request['default'])
            $this->setting->editBySlug('default_plan',[
                'title'=>'default plan',
                'value' => $plan->id
            ]);

        return [
            $plan
        ];
    }

    public function edit($request)
    {
        $this->repo->find($request['id'])
            ->update($request);

        return $this->repo->find($request['id']);
    }

    public function assign($request)
    {
        $user = $this->userRepo->find($request->user_id);
        return $user->assignRole($request->plan);
    }

    public function delete($request)
    {
        $this->repo->delete($request['id']);
    }
}
