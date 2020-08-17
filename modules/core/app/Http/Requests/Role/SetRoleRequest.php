<?php

namespace Core\app\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class SetRoleRequest extends FormRequest
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
            'description' => 'string'
        ];
    }

    public function getData()
    {
        return $this->only('title','description');
    }
}
