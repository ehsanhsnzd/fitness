<?php

namespace Core\app\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'id' => 'required|numeric|exists:roles,id',
            'name' => 'required|string',
            'description' => 'string'
        ];
    }


    public function getData()
    {
        return $this->only('id','name','description');
    }

}
