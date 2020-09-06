<?php
namespace Member\Http\Controllers;

use Core\Exceptions\ExceptionHandler;
use Core\Http\Controllers\BaseController;
use Member\Http\Requests\User\RefreshRequest;
use Member\Http\Requests\User\RegisterRequest;
use Member\Services\ProfileService;
use Member\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends BaseController
{
    use ExceptionHandler;
    protected $service;

    public function __construct($service =null)
    {
        $this->service = $service ?? new ProfileService();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try{
            return $this->setMetaData($this->service->update($request->all()))
                ->successResponse();
        } catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }


}
