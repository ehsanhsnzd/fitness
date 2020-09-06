<?php


namespace Member\Http\Controllers;


use Core\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Member\Http\Requests\Role\RegisterRoleRequest;
use Member\Http\Requests\Role\GetRoleRequest;
use Member\Services\RoleService;

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
            return $this->setMetaData($this->service->all())->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function current(Request $request)
    {
        try{
            return $this->setMetaData($this->service->current())->successResponse();
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
