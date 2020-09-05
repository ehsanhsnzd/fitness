<?php
namespace Member\app\Http\Controllers;

use Core\app\Exceptions\ExceptionHandler;
use Core\app\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Member\app\Http\Requests\User\LoginRequest;
use Member\app\Http\Requests\User\RefreshRequest;
use Member\app\Http\Requests\User\RegisterRequest;
use Member\app\Services\UserService;
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
