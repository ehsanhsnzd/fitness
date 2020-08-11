<?php


namespace Member\app\Http\Controllers;


use Illuminate\Http\Request;
use Member\app\Services\PlanService;
use Member\app\Traits\ApiResponse;

class PlanController
{
    use ApiResponse;
    protected $service;
    public function __construct(PlanService $service)
    {
        $this->service = $service ?? new PlanService();
    }

    /** assign a plan to user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assign(Request $request)
    {
        try{
            $this->service->assign($request);
            return $this->setMetaData([])->successResponse();
        }catch (\Exception $exception){
            return $this->customResponse($exception->getMessage(),500,500);
        }
    }
}
