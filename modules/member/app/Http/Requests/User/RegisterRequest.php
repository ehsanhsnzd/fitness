<?php


namespace Member\app\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function rules()
    {
        return [
            'mobile' => 'required|string|max:11',
            'password' => 'required',
            'verify_password' => 'required|same:password'
        ];
    }

    public function getData()
    {
        return $this->only('mobile','password','verify_password');
    }
}
