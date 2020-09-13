<?php namespace Member\Services;


use Carbon\Carbon;
use Core\Services\SettingService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as oClient;
use Member\Repositories\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $repo;
    private $setting;
    private $role;

    public function __construct()
    {
        $this->repo = new UserRepository();
        $this->setting = new SettingService();
        $this->role = new RoleService();
    }

    public function register($request)
    {

        $defaultPlan = $this->setting->name('default_plan');
        $password = request('password');
        $request['password'] = bcrypt($password);
        $request['start_date'] = Carbon::now();
        $user = $this->repo->create($request);

        if ($defaultPlan)
            $this->role->assignPlan($user, $defaultPlan);


        $oClient = OClient::where('password_client', 1)->first();
        $params = ['form_params' => [
            'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $request['mobile'],
            'password' => $password,
            'scope' => '*',
        ]];


        return [
            'auth' => $this->getTokenAndRefreshToken($params),
            'profile' => $user->profile()->create(['name' => '', 'last_name' => ''])
        ];
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

        $user = auth('users-api')->user();
        return [
            'auth' => $this->getTokenAndRefreshToken($params),
            'profile' => $user ? $user->profile()->create(['name' => '', 'last_name' => '']) :
                (object)[
                    "id" => 0,
                    "user_id" => 0,
                    "name" => "",
                    "last_name" => "",
                    "created_at" => "",
                    "updated_at" => ""
                ]
        ];

    }

    public function login($request)
    {
        $auth = Auth::guard('users')->attempt(['mobile' => request('mobile'), 'password' => request('password')]);
        if ($auth) {
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
        return [
            'auth' => $this->getTokenAndRefreshToken($params),
            'profile' => $this->repo->where(['mobile' => $request->mobile])->first()->profile()->first()
        ];

    }

    /**
     * @param $request
     * @return mixed
     */
    public function logout($request)
    {
        if (isset($request->user()->tokens))
            return [$request->user()->token()->revoke()];

        return [];
    }

    /**
     * registered before
     * @param $request
     * @return array
     */
    public function check($request)
    {
        return [$this->repo->where(['mobile' => $request['mobile']])
            ->get()->isNotEmpty()];
    }

    /**
     * @param $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTokenAndRefreshToken($params)
    {

        $http = new Client;
        $response = $http->request('POST', request()->root() . '/oauth/token', $params);
        $res = json_decode((string)$response->getBody(), true);
        $res['expires_in_date'] = (new Carbon(Carbon::now()->timestamp + $res['expires_in']))->toDateString();
        return $res;
    }
}
