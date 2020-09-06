<?php
namespace Core\Http\Controllers;


use Core\Http\Requests\Category\DeleteCategoryRequest;
use Core\Http\Requests\Category\EditCategoryRequest;
use Core\Http\Requests\Category\GetCategoryRequest;
use Core\Http\Requests\Category\SetCategoryRequest;
use Core\Http\Requests\Category\UploadCategoryRequest;
use Core\Services\CategoryService;

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


    public function upload(UploadCategoryRequest $request)
    {
        try{
            return $this->setMetaData([$request->getData()['photo']])->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }


}
