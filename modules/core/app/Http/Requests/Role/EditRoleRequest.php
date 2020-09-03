<?php

namespace Core\app\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class EditRoleRequest extends FormRequest
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
            'id' => 'required|numeric|exists:plans,id',
            'title' => 'nullable|required|string',
            'description' => 'nullable|string',
            'expire_days' => 'nullable|required|numeric'
        ];
    }

    public function getData()
    {
        return $this->only('id','title','description','expire_days');
    }

}
