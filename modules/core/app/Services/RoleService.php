<?php


namespace Core\app\Services;


use Core\app\repositories\RoleRepository;
use Member\app\Models\User;

class RoleService
{
    /**
     * @var RoleRepository
     */
    private $repo;

    public function __construct($repo= null)
    {
        $this->repo = $repo ?? new RoleRepository();
    }

    public function get($request)
    {
        return $this->repo->find($request->id)->toArray();
    }

    public function edit($request)
    {
        $this->repo->find($request['id'])
            ->update($request);

        return $this->repo->find($request['id']);
    }

    public function assign($request)
    {
        $user = User::find($request->user_id);
        $user->assignRole($request->plan);
    }

    public function delete()
    {

    }
}
