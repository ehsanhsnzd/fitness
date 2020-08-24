<?php


namespace Member\app\Http\Controllers;


use Core\app\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Member\app\Http\Requests\Role\RegisterRoleRequest;
use Member\app\Http\Requests\Role\GetRoleRequest;
use Member\app\Services\RoleService;

class RoleController extends BaseController
{
    protected $service;
    public function __construct(RoleService $service)
    {
        $this->service = $service ?? new RoleService();
    }

    public function all(Request $request)
    {
        try{
            return $this->setMetaData($this->service->all($request))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function current(Request $request)
    {
        try{
            return $this->setMetaData($this->service->current($request))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function get(GetRoleRequest $request)
    {
        try{
            return $this->setMetaData($this->service->get($request->getData()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function register(RegisterRoleRequest $request)
    {
        try{
            return $this->setMetaData($this->service->register($request->getData()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }


}
