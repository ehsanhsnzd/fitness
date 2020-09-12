<?php


namespace Member\Services;


use Core\Services\BaseService;
use Member\Repositories\DedicatedPlanRepository;

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
//
//    public function get($request)
//    {
//        return  $this->repo->find($request['id'])
//            ->items($request['id'])->with('item','itemInfo')
//            ->get()
//            ->toArray();
//    }

    public function get($request)
    {
        $items =$this->repo->find($request->id)->items(1);
        $itemsIDs = $items->pluck('item_id')->toArray();
        $itemsInfosIDs = $items->pluck('item_info_id')->toArray();

        $categories= $items->with(['categories'=>function($query) use($itemsIDs,$itemsInfosIDs){
            return $query->with(['items'=>function($query)use($itemsIDs,$itemsInfosIDs){
                $query->whereIn('id',$itemsIDs)->with(['itemInfo'=>function($query)use($itemsInfosIDs){
                    $query->whereIn('id',$itemsInfosIDs);
                }]);
            }]);
        }])->get();

        return $categories->pluck('categories.0')->toArray();

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
