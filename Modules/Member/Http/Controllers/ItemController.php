<?php


namespace Member\Http\Controllers;


use Core\Http\Controllers\BaseController;
use Member\Http\Requests\Category\GetCategoryRequest;
use Member\Http\Requests\Item\FilesItemRequest;
use Member\Http\Requests\Item\GetItemRequest;
use Member\Http\Requests\Item\PhotoItemRequest;
use Member\Services\ItemService;

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
            return $this->setMetaData($this->service->get($request))->successResponse();
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function photo(PhotoItemRequest $request)
    {
        try {
            return response()->file($this->service->photo($request));
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }


    public function file(PhotoItemRequest $request)
    {
        try {
            return response()->download($this->service->file($request));
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    public function files(FilesItemRequest $request)
    {
        try {
            return response()->download($this->service->files($request));
        }catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }
}
