<?php
namespace Member\app\Http\Controllers;

use Core\app\Exceptions\ExceptionHandler;
use Core\app\Http\Controllers\BaseController;
use Member\app\Http\Requests\User\RefreshRequest;
use Member\app\Http\Requests\User\RegisterRequest;
use Member\app\Services\ProfileService;
use Member\app\Services\UserService;
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
