<?php


namespace Member\app\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;
use Member\app\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'mobile' => 'required|string|max:11|exists:users,mobile',
            'password' => 'required',
        ];
    }

    public function getData()
    {
        return $this->only('mobile','password');
    }
}
