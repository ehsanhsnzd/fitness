<?php
namespace Core\Services;


use Core\Models\Admin;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as oClient;

class AdminService
{
    public function register($request)
    {

        $password = request('password');
        $input = $request->all();
        $input['password'] = bcrypt($password);
        Admin::create($input);
        $oClient = OClient::where('name', 'admin')->first();
        $params = ['form_params' => [
        'grant_type' => 'password',
        'client_id' => $oClient->id,
        'client_secret' => $oClient->secret,
        'username' => $request->email,
        'password' => $password,
        'scope' => '*',
        ]];
        return $this->getTokenAndRefreshToken($params);
    }

    public function refresh($request)
    {
        $oClient = OClient::where('name', 'admin')->first();
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

        if (Auth::guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])) {
            $oClient = oClient::where('name', 'admin')->first();
        }
        $params = ['form_params' => [
            'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $request->email,
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
