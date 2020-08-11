<?php   namespace Member\app\Services;


use Member\app\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register($request)
    {
        $input = $request->all();
        $user = User::create($input);
        $user->password = Hash::make($input['password']);
        $user->save();
        return $user->toArray();
    }


    public function login($request)
    {

        $token = auth('users')->attempt(['email' => $request->email, 'password' => $request->password]);

        return [$token];
    }
}
