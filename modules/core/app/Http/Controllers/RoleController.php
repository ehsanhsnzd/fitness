<?php


namespace Core\app\Http\Controllers;


use Core\app\Http\Requests\Role\GetRoleRequest;
use Core\app\Http\Requests\Role\UpdateRoleRequest;
use Illuminate\Http\Request;
use Core\app\Services\RoleService;

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

    public function get(GetRoleRequest $request)
    {
        try{
            return $this->setMetaData($this->service->get($request->getData()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function set(UpdateRoleRequest $request)
    {
        try{
            return $this->setMetaData($this->service->edit($request->getData()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function edit(UpdateRoleRequest $request)
    {
        try{

            return $this->setMetaData([$this->service->edit($request->getData())])->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function delete(Request $request)
    {
        try{
            return $this->setMetaData($this->service->delete($request->getData()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }


    public function assign(Request $request)
    {
        try{
            $this->service->assign($request);
            return $this->setMetaData([])->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }
}
