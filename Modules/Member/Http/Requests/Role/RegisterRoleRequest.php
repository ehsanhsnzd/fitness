<?php

namespace Member\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Member\Http\Requests\BaseRequest;

class RegisterRoleRequest extends BaseRequest
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
            'plan_id' => 'required|numeric|exists:plans,id'
        ];
    }

    public function getData($keys = null)
    {
        return $this->only('plan_id');
    }
}
