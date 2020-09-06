<?php


namespace Core\Http\Controllers;


use Core\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    /**
    * @var mixed|null
    */
    private $service;

    public function __construct($service = NULL){
        $this->service = new SettingService();
    }

    public function get(Request $request)
    {
        try{
            return $this->setMetaData($this->service->get($request))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function getSlug(Request $request)
    {
        try{
            return $this->setMetaData($this->service->getSlug($request))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function set(Request $request)
    {
        try{
            return $this->setMetaData($this->service->set($request->all()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function edit(Request $request)
    {
        try{
            return $this->setMetaData($this->service->edit($request->all()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function delete(Request $request)
    {
        try{
            $this->service->delete($request);
            return $this->setMetaData([])->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }
}
