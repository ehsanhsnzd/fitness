<?php   namespace Trainer\app\Services;


use Trainer\app\Models\Trainer;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register($request)
    {
        $input = $request->all();
        $user = Trainer::create($input);
        $user->password = Hash::make($input['password']);
        $user->save();
        return $user->toArray();
    }


    public function login($request)
    {

        $token = auth('trainer')->attempt(['email' => $request->email, 'password' => $request->password]);

        return [$token];
    }
}
