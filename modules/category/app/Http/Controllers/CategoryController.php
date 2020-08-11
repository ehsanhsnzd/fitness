<?php
namespace Category\app\Http\Controllers;


use App\Http\Controllers\Controller;
use Category\app\Http\Requests\CategoryRequest;
use Category\app\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $service;
    public function __construct($service = null)
    {
        $this->service = $service ?? new CategoryService;
    }

    public function get(CategoryRequest $request)
    {
        try{
           return $this->service->get($request);
        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function set(Request $request)
    {
        try {
            return $this->service->set($request);
        }catch (\Exception $exception){
            return $exception;
        }
    }


    public function edit(Request $request)
    {
        try {
            return $this->service->edit($request);
        }catch (\Exception $exception){
            return $exception;
        }
    }


}
