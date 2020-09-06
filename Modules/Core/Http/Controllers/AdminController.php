<?php
namespace Core\Http\Controllers;

use Core\Exceptions\ExceptionHandler;
use Core\Http\Controllers\BaseController;
use Core\Services\AdminService;
use Member\Services\UserService;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    use ExceptionHandler;
    protected $service;

    public function __construct($service =null)
    {
        $this->service = $service ?? new AdminService();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try{
            return $this->setMetaData($this->service->register($request))
                ->successResponse();
        } catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
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
     * @return \Illuminate\Http\JsonResponse
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request)
    {
        try{
            return $this->setMetaData($this->service->refresh($request))
                ->successResponse();
        } catch (\Exception $exception){
            return $this->handleException($request,$exception);
        }
    }
}
