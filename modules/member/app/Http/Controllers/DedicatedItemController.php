<?php


namespace Member\app\Http\Controllers;


use Core\app\Http\Controllers\AbstractController;
use Core\app\Services\BaseService;
use Member\app\Models\UserDedicatedItem;

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
