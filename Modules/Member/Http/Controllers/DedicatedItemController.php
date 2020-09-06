<?php


namespace Member\Http\Controllers;


use Core\Http\Controllers\AbstractController;
use Core\Services\BaseService;
use Member\Models\UserDedicatedItem;

class DedicatedItemController extends AbstractController
{
    /**
    * @var mixed|null
    */
    protected $service;

    public function __construct($service = NULL){
        $this->service =
            new BaseService(UserDedicatedItem::class);
    }


}
