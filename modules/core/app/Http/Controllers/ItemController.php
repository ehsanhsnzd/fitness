<?php


namespace Core\app\Http\Controllers;


use Core\app\Http\Requests\Item\DeleteItemRequest;
use Core\app\Http\Requests\Item\EditItemRequest;
use Core\app\Http\Requests\Item\GetItemRequest;
use Core\app\Http\Requests\Item\SetItemRequest;
use Core\app\Services\ItemService;

class ItemController extends BaseController
{
    protected $service;
    public function __construct($service = null)
    {
        $this->service = $service ?? new ItemService();
    }

    public function get(GetItemRequest $request)
    {
        try{
            return $this->setMetaData($this->service->get($request->all()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function set(SetItemRequest $request)
    {
        try{
            return $this->setMetaData($this->service->set($request->getData()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function edit(EditItemRequest $request)
    {
        try{

            return $this->setMetaData($this->service->edit($request->getData()))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function delete(DeleteItemRequest $request)
    {
        try{
            $this->service->delete($request->all());
            return $this->setMetaData([])->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }
}
