<?php   namespace Member\app\Services;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as oClient;
use Member\app\Models\User;
use Member\app\Repositories\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }
    public function register($request)
    {

        $password = request('password');
        $request['password'] = bcrypt($password);
        $this->repo->create($request);
        $oClient = OClient::where('password_client', 1)->first();
        $params = ['form_params' => [
        'grant_type' => 'password',
        'client_id' => $oClient->id,
        'client_secret' => $oClient->secret,
        'username' => $request['mobile'],
        'password' => $password,
        'scope' => '*',
        ]];
        return $this->getTokenAndRefreshToken($params);
    }

    public function refresh($request)
    {
        $oClient = OClient::where('password_client', 1)->first();
        $params = ['form_params' => [
            'grant_type' => 'refresh_token',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'refresh_token' => $request->refresh_token,
            'scope' => '*',
        ]];
        return $this->getTokenAndRefreshToken($params);

    }

        public function login($request)
    {

        if (Auth::guard('users')->attempt(['mobile' => request('mobile'), 'password' => request('password')])) {
            $oClient = oClient::where('password_client', 1)->first();
        }

        $params = ['form_params' => [
            'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $request->mobile,
            'password' => $request->password,
            'scope' => '*',
        ]];
        return $this->getTokenAndRefreshToken($params);

    }

    /**
     * @param $request
     * @return mixed
     */
    public function logout($request)
    {
        if(isset($request->user()->tokens))
            return [$request->user()->token()->revoke()];

        return [];
    }

    /**
     * @param $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTokenAndRefreshToken($params) {

        $http = new Client;
        $response = $http->request('POST', request()->root().'/oauth/token',$params);
        return json_decode((string) $response->getBody(), true);

    }
}
