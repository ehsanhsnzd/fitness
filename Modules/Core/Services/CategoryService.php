<?php
namespace Core\Services;



use Core\repositories\CategoryRepository;
use Core\repositories\PermissionRepository;
use Core\repositories\PlanRepository;

class CategoryService
{
    private $repo;
    private $planRepo;
    private $permissionRepo;
    private $user;

    public function __construct( $repository = null)
    {
        $this->user = auth('users-api')->user();
        $this->repo = $repository ?? new CategoryRepository();
        $this->planRepo = new PlanRepository();
        $this->permissionRepo = new PermissionRepository();
    }

    public function all()
    {
        $categories = $this->repo->fetch(null,['nodes','items'],'parent_id');
        $categories = $this->extractDescription($categories);

        return
            $categories->toArray();
    }

    /** get category by id
     * @param $request
     * @return array
     */
    public function get($request)
    {
        $category = $this->repo->fetch($request['id'],['nodes','items']);
        $category = $this->extractDescription($category);

        $subCategories = $category->first()->nodes()->get();

        $category = $this->allItems($category->first(),$subCategories);
        $category->put('nodes',$this->hasAccess($subCategories));



        return
            $category->toArray();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function set($request)
    {

        $request['description'] = json_encode($request['description']);
        $request['photo'] = asset('storage/category/'.$request['photo']);

        $category = $this->repo->create($request);

        $this->syncPermission($category,$request);


        return [
            $category
        ];
    }


    public function edit($request)
    {
        $permission = $this->permissionRepo->where(['name' => 'category.'.$request['id']])->first();

        if($permission)
            $permission->delete();

        $request['description'] = json_encode($request['description']);
        $request['photo'] = asset('storage/category/'.$request['photo']);

        $category = $this->repo->find($request['id']);
        $category->update($request);

        $this->syncPermission($category,$request);

        return [
            $this->repo->update($request['id'],$request)
        ];
    }

    public function delete($request)
    {
        $this->permissionRepo->where(['name' => 'category.'.$request['id']])->first()->delete();
        $this->repo->delete($request['id']);
    }

    public function extractDescription($categories)
    {
        return collect($categories)->map(function ($cat){
            $cat->description = json_decode($cat->description);
            return $cat;
        });
    }

    public function syncPermission($category,$request)
    {
        $plan = $this->planRepo->model()->whereIn('id',$request['plan_id'])
            ->get();
        $permission = $this->permissionRepo->create([
            'name' => 'category.'.$category->id,
            'guard_name' => 'users'
        ]);
        $category->plan()->sync($request['plan_id']);

        $plan->map(function($plan) use ($permission){
            $role = $plan->role()->first();
            $role->givePermissionTo($permission);
        });
    }

    public function allItems($category,$subCategories)
    {
        $allItems = collect($subCategories)->reduce(function($arr, $category) {
            if($arr==null)
                $arr = collect($arr);

            return $arr->merge($category->items()->get());
        });
        return $categories = collect($category)->put('allItems',$allItems) ;
    }

    public function hasAccess(\Illuminate\Support\Collection $categories)
    {
        return collect($categories)->map(function($category) {
             $category->access = $this->user->can('category.'.$category->id);
             return $category;
        });

    }
}
