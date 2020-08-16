<?php
namespace Trainer\app\Http\Controllers;


use Core\app\Http\Controllers\BaseController;
use Core\app\Http\Requests\Role\GetRoleRequest;
use Core\app\Services\CategoryService;

class CategoryController extends BaseController
{
    protected $service;
    public function __construct($service = null)
    {
        $this->service = $service ?? new CategoryService;
    }


    public function get(GetRoleRequest $request)
    {
        try{
            return $this->setMetaData($this->service->get($request->getData()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }



}
