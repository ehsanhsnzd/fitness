<?php


namespace Member\app\Http\Controllers;


use Core\app\Http\Controllers\BaseController;
use Member\app\Http\Requests\Category\GetCategoryRequest;
use Member\app\Http\Requests\Item\GetItemRequest;
use Member\app\Http\Requests\Item\MediaItemRequest;
use Member\app\Services\ItemService;

class ItemController extends BaseController
{
    /**
    * @var mixed|null
    */
    private $service;

    public function __construct($service = NULL){
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

    public function media(MediaItemRequest $request)
    {
        try {
            return response()->file($this->service->media($request));
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }


    public function file(MediaItemRequest $request)
    {
        try {
            return response()->download($this->service->file($request));
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }
}
