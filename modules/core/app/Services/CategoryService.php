<?php
namespace Core\app\Services;



use Core\app\repositories\CategoryRepository;
use Core\app\repositories\PermissionRepository;
use Core\app\repositories\RoleRepository;

class CategoryService
{
    private $repo;
    private $roleRepo;
    private $permissionRepo;

    public function __construct( $repository = null)
    {
        $this->repo = $repository ?? new CategoryRepository();
        $this->roleRepo = new RoleRepository();
        $this->permissionRepo = new PermissionRepository();
    }



    /** get category by id
     * @param $request
     * @return array
     */
    public function get($request)
    {
        $categories = $this->repo->fetch($request['id'],['nodes']);

        return
            $categories->toArray();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function set($request)
    {
        $category = $this->repo->create($request);
        $role = $this->roleRepo->where('name',$request['plan'])->first();
        $permission = $this->permissionRepo->create([
            'name' => 'category.'.$category->id,
            'guard_name' => 'users'
        ]);
        $role->givePermissionTo($permission);

        return [
            $category
        ];
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
