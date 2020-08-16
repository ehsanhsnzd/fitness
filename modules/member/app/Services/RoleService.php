<?php


namespace Member\app\Services;



use Carbon\Carbon;
use Core\app\repositories\RoleRepository;
use Symfony\Component\Finder\Exception\AccessDeniedException;

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

    public function register($request)
    {
        $user = auth()->guard('users-api')->user();
        $selected =$user->selected();
        $roleId = $this->repo->where('name',$request['plan'])
            ->first()->id;


        /** if registered before  */
        $active = $selected->get()->find($roleId)->active ?? false;
        if($selected->get()->find($roleId) && !$active)
            throw new AccessDeniedException('registered once before');

        //TODO add from settings
        $user->expire_date = Carbon::now()->addDays(2)->timestamp;
        $user->save();


        $selected->where('active',false)->pluck('name')->map(function ($key) use ($user){
            $user->removeRole($key);
        });
        $selected->syncWithoutDetaching($roleId);

        return [
            $user->assignRole($request['plan'])
        ];
    }

}
