<?php

namespace Core\app\Http\Requests\Role;

use Core\app\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class SetRoleRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'string',
            'expire_days' => 'required|numeric',
            'default' => 'required|bool'
        ];
    }

    public function getData()
    {
        return $this->only('title','description','expire_days','default');
    }
}
