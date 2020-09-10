<?php
namespace Member\Http\Controllers;


use Core\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Member\Http\Requests\Category\GetCategoryRequest;
use Member\Services\CategoryService;

class CategoryController extends BaseController
{
    protected $service;
    public function __construct($service = null)
    {
        $this->service = $service ?? new CategoryService();
    }

    public function all(Request $request)
    {
        try{
            return $this->setMetaData($this->service->all())->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function getAllItems(GetCategoryRequest $request)
    {
        try{
            return $this->setMetaData($this->service->getWithAllItems($request->all()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function get(GetCategoryRequest $request)
    {
        try{
            return $this->setMetaData($this->service->get($request->all()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }



}
