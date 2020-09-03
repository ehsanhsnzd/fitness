<?php


namespace Member\app\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
