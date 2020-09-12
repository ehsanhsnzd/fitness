<?php


namespace Member\Http\Controllers;


use Core\Http\Controllers\AbstractController;
use Core\repositories\BaseRepository;
use GuzzleHttp\Psr7\Request;
use Member\Http\Requests\DedicatedPlan\GetDedicatedPlanRequest;
use Member\Models\UserDedicatedPlan;
use Member\Services\DedicatedPlanService;

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

    public function get(\Illuminate\Http\Request $request)
    {

        try{
             return $this->setMetaData($this->service->get($request))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }



}
