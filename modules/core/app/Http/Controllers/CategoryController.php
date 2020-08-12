<?php
namespace Core\app\Http\Controllers;


use Core\app\Http\Requests\Role\GetRoleRequest;
use Core\app\Http\Requests\Role\UpdateRoleRequest;
use Core\app\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $service;
    public function __construct($service = null)
    {
        $this->service = $service ?? new CategoryService;
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
            $this->service->delete($request->getData());
            return $this->setMetaData([])->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }


}
