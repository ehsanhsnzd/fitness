<?php

namespace Core\Http\Requests\Category;

use Core\Http\Requests\BaseRequest;

class SetCategoryRequest extends BaseRequest
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
            'plan_id'  => 'required|array',
            'public' => 'bool',
            'parent_id' =>'nullable|numeric|exists:categories,id',
            'photo' => 'string',
            'description' => 'array'
        ];
    }


    public function getData()
    {
        return $this->only('title','plan_id','parent_id','public','photo','description');
    }
}
