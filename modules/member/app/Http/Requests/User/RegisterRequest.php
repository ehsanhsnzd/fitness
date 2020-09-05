<?php


namespace Member\app\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;
use Member\app\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'mobile' => 'required|string|max:11|unique:users,mobile',
            'password' => 'required',
            'verify_password' => 'required|same:password'
        ];
    }

    public function getData()
    {
        return $this->only('mobile','password','verify_password');
    }
}
