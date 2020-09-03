<?php
namespace Member\app\Http\Controllers;


use Core\app\Http\Controllers\BaseController;
use Core\app\Services\CategoryService;
use Illuminate\Http\Request;
use Member\app\Http\Requests\Category\GetCategoryRequest;

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

    public function get(GetCategoryRequest $request)
    {
        try{
            return $this->setMetaData($this->service->get($request->all()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }



}
