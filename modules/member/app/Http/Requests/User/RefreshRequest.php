<?php


namespace Member\app\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class RefreshRequest extends FormRequest
{

    public function rules()
    {
        return [
            'refresh_token' => 'required',
        ];
    }

    public function getData()
    {
        return (object)$this->only('refresh_token');
    }
}
