<?php


namespace Member\app\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;
use Member\app\Http\Requests\BaseRequest;

class RefreshRequest extends BaseRequest
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
