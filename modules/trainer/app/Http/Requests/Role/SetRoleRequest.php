<?php

namespace Trainer\app\Http\Requests\Role;

use Category\app\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Trainer\app\Models\Trainer;

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
            'name' => 'required|string',
            'description' => 'string'
        ];
    }

}
