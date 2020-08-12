<?php
namespace Member\app\Http\Controllers;

use Member\app\Services\UserService;
use Member\app\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends AbstractController
{
    use ApiResponse;
    protected $service;

    public function __construct($service =null)
    {
        $this->service = $service ?? new UserService();
    }

    public function register(Request $request)
    {
        try{
            return $this->setMetaData($this->service->register($request))
                ->successResponse();
        } catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function login(Request $request)
    {
        try{
            return $this->setMetaData($this->service->login($request))
                ->successResponse();
        } catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
