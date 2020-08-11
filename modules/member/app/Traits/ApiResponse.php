<?php

namespace Member\app\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;

/**
 *
 * @Schema(
 *   schema="meta",
 *   type="object",
 *   allOf={
 *       @Schema(
 *          @Property (property= "msg", type="string"),
 *          @Property (property= "status", type="string"),
 *       )
 *   }
 * )
 *
 * Trait ApiResponse
 * @package App\Traits
 */

trait ApiResponse
{

    protected $msg;
    protected $status;
    protected $httpCode;
    protected $statusCode;
    protected $meta = [];
    protected $data = null;


    /**
     * @param array $data
     * @param array $meta
     * @return $this
     * @throws Exception
     */
    public function setMetaData(array $data, array $meta = [])
    {
        if ( isset($meta["msg"]) || isset($meta["status"]) )
            throw new Exception("you can't set meta[msg] or meta[status] from this method. use customResponse to set msg and status manually");
        $this->meta = $meta;
        $this->data = $data;
        return $this;
    }

    private function setMsgAndStatus($msg, $status, int $statusCode = 0)
    {
        $this->meta["msg"]       	 = $msg;
        $this->meta["status"]    	 = $status;
        $this->meta["statusCode"]    = $statusCode;
    }
    /**
     * @return JsonResponse
     */
    public function response():JsonResponse
    {
    	$this->getStepToken();
		//TODO :: FIRE AN EVENT TO STORE IN LOG EVERY RESPONSE
		$data = [
			'meta'      => $this->meta,
			'data'      => $this->data,
		];
		//FIXME
//		if(isset($this->data['stepToken']))
//		{
//			$logDate 				= $data;
//			$logDate['stepToken'] 	= $this->data['stepToken'];
//			dispatch(new CustomLogJob( $logDate, LOG_RESPONSE )); //TODO stepToken????
//		}

        return response()->json( $data, $this->httpCode );
    }

    /**
     * @return JsonResponse
     */
    public function successResponse():JsonResponse
    {
         $this->setMsgAndStatus('Your request Successfully handled.','Success');

         $this->httpCode    = 200;

         return $this->response();
    }

    /**
     * @return JsonResponse
     */
    public function notFoundResponse():JsonResponse
    {
        $this->setMsgAndStatus('Your requested resource was not found.','Failed');

        $this->httpCode    = 404;

        return $this->response();

    }

    /**
     * @return JsonResponse
     */
    public function failedResponse():JsonResponse
    {
        $this->setMsgAndStatus('Sorry. Internal server error.','Failed');

        $this->httpCode    = 500;

        return $this->response();

    }

    /**
     * @return JsonResponse
     */
    public function notAuthenticatedResponse():JsonResponse
    {
        $this->setMsgAndStatus('Not Authenticated. Make sure your token is valid','Failed');

        $this->httpCode    = 401;

        return $this->response();

    }

    /**
     * @return JsonResponse
     */
    public function methodNotAllowedHttpException():JsonResponse
    {
        $this->setMsgAndStatus('Method not allowed!','Failed');

        $this->httpCode    = 405;

        return $this->response();

    }

    /**
     * @return JsonResponse
     */
    public function notAuthorizedResponse():JsonResponse
    {
        $this->setMsgAndStatus('You are not authorized!','Failed');

        $this->httpCode    = 403;

        return $this->response();

    }

    /**
     * @return JsonResponse
     */
    public function badRequestResponse():JsonResponse
    {
        $this->setMsgAndStatus('The request is not in accepted format','Failed');

        $this->httpCode    = 400;

        return $this->response();

    }

    /**
     * @return JsonResponse
     */
    public function stepTokenNotValidResponse():JsonResponse
    {
        $this->setMsgAndStatus('The step token you sent is not valid or expired','Failed');

        $this->httpCode    = 404;

        return $this->response();
    }


    /**
     * @param string $msg
     * @param string $status
     * @param int $httpCode
     * @param int|null $statusCode
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function customResponse(string $msg, string $status, int $httpCode, int $statusCode = 0,$data = null):JsonResponse
    {
        $this->setMsgAndStatus($msg, $status, $statusCode);

        $this->httpCode    = $httpCode;
        $this->data        = $data;

        return $this->response();

    }


	/**
	 * return debug step and search token if debug in .env is true
	 */
	private function getStepToken()
	{
		if(env('DEBUG')) { //TODO fix it
			$guard = Auth::guard('agent');

			if( $guard->check() && Cache::has('SearchToken' . $guard->user()->id)) {
				$agent = $guard->user();
				if(strpos(app('request')->url(), "v1/hotel/search") ||
                    strpos(app('request')->url(), "v1/hotel/cancellation-policy")) {
					$this->meta['DebugSearchToken'] = Cache::get('SearchToken' . $agent->id) ?? null;
				} else {
					$stepToken = Cache::get('StepToken' . $agent->id);
					$stepToken ? $this->meta['DebugStepToken'] = $stepToken : null;
				}
			}

		}
	}
}
