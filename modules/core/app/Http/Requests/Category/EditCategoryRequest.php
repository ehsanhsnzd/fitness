<?php

namespace Core\app\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
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
            'id'    =>  'required|numeric',
            'title' => 'required|string',
            'plan'  => 'required|string|exists:roles,name',
            'parent_id' => 'numeric',
            'public' => 'bool'
        ];
    }


    public function getData()
    {
        return $this->only('id','title','plan','parent_id','public');
    }
}
