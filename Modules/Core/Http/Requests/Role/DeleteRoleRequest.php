<?php

namespace Core\Http\Requests\Role;

use Core\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRoleRequest extends BaseRequest
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
            'id' => 'required|numeric|exists:roles,id'
        ];
    }

    public function all($keys = null)
    {
        return ['id' => app('request')->id];
    }

}
