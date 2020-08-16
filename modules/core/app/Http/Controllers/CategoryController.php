<?php
namespace Core\app\Http\Controllers;


use Core\app\Http\Requests\Category\DeleteCategoryRequest;
use Core\app\Http\Requests\Category\EditCategoryRequest;
use Core\app\Http\Requests\Category\GetCategoryRequest;
use Core\app\Http\Requests\Category\SetCategoryRequest;
use Core\app\Services\CategoryService;

class CategoryController extends BaseController
{
    protected $service;
    public function __construct($service = null)
    {
        $this->service = $service ?? new CategoryService;
    }


    public function get(GetCategoryRequest $request)
    {
        try{
            return $this->setMetaData($this->service->get($request->all()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function set(SetCategoryRequest $request)
    {
        try{
            return $this->setMetaData($this->service->set($request->getData()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function edit(EditCategoryRequest $request)
    {
        try{

            return $this->setMetaData($this->service->edit($request->getData()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function delete(DeleteCategoryRequest $request)
    {
        try{
            $this->service->delete($request->all());
            return $this->setMetaData([])->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }


}
