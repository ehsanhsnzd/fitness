<?php

namespace Member\app\Http\Requests\Role;

use Category\app\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Member\app\Models\Trainer;

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
