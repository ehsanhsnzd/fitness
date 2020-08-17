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

    public function __construct($repo= null)
    {
        $this->repo = $repo ?? new RoleRepository();
        $this->userRepo = new UserRepository();
        $this->planRepo = new PlanRepository();
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
        $request['guard_name'] = 'users';
        $role = $this->repo->create($request);
        $request['role_id'] = $role->id;
        return $this->planRepo->create($request)->toArray();
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
