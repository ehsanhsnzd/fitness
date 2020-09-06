<?php
namespace Member\Http\Controllers;

use Core\Exceptions\ExceptionHandler;
use Core\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Member\Http\Requests\User\LoginRequest;
use Member\Http\Requests\User\RefreshRequest;
use Member\Http\Requests\User\RegisterRequest;
use Member\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    use ExceptionHandler;
    protected $service;

    public function __construct($service =null)
    {
        $this->service = $service ?? new UserService();
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try{
            return $this->setMetaData($this->service->register($request->getData()))
                ->successResponse();
        } catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try{
            return $this->setMetaData($this->service->login($request))
                ->successResponse();
        } catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        try{
            return $this->setMetaData($this->service->logout($request))
                ->successResponse();
        } catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    /**
     * @param RefreshRequest $request
     * @return JsonResponse
     */
    public function refresh(RefreshRequest $request)
    {
        try{
            return $this->setMetaData($this->service->refresh($request->getData()))
                ->successResponse();
        } catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

        public function check(Request $request)
    {
        try{
            return $this->setMetaData($this->service->check($request->all()))
                ->successResponse();
        } catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }


}
