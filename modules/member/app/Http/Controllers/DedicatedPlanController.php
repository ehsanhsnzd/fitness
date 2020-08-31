<?php


namespace Member\app\Http\Controllers;


use Core\app\Http\Controllers\AbstractController;
use Core\app\repositories\BaseRepository;
use Member\app\Http\Requests\DedicatedPlan\GetDedicatedPlanRequest;
use Member\app\Models\UserDedicatedPlan;
use Member\app\Services\DedicatedPlanService;

class DedicatedPlanController extends AbstractController
{
    /**
    * @var mixed|null
    */
    protected $service;

    public function __construct($service = NULL){
        $this->service =
            new DedicatedPlanService();
    }


    public function getDays(GetDedicatedPlanRequest $request)
    {
        $this->service->repo = $request['repo'];

        try{
             $this->setMetaData($this->service->getDays($request))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

}
