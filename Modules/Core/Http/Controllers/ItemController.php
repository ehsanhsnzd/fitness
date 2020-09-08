<?php


namespace Core\Http\Controllers;


use Core\Http\Requests\Item\DeleteItemRequest;
use Core\Http\Requests\Item\EditItemRequest;
use Core\Http\Requests\Item\GetItemRequest;
use Core\Http\Requests\Item\SetItemRequest;
use Core\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    protected $service;
    public function __construct($service = null)
    {
        $this->service = $service ?? new ItemService();
    }


    public function all(Request $request)
    {
        try{
            return $this->setMetaData($this->service->all())->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
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
