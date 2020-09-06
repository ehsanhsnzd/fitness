<?php


namespace Core\Http\Controllers;


use Core\Http\Requests\Role\EditRoleRequest;
use Core\Http\Requests\Role\GetRoleRequest;
use Core\Http\Requests\Role\DeleteRoleRequest;
use Core\Http\Requests\Role\SetRoleRequest;
use Illuminate\Http\Request;
use Core\Services\RoleService;

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
            return $this->setMetaData($this->service->get($request->all()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function set(SetRoleRequest $request)
    {
        try{
            return $this->setMetaData($this->service->set($request->getData()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function edit(EditRoleRequest $request)
    {
        try{

            return $this->setMetaData([$this->service->edit($request->getData())])->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function delete(DeleteRoleRequest $request)
    {
        try{
            $this->service->delete($request->all());
            return $this->setMetaData([])->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }


    public function assign(Request $request)
    {
        try{
            return $this->setMetaData([$this->service->assign($request)])->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }
}
