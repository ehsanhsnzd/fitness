<?php

namespace Core\app\Http\Requests\Category;

use Core\app\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends BaseRequest
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
            'id'    => 'required|numeric|exists:categories,id',
            'title' => 'nullable|string',
            'plan_id'  => 'nullable|array',
            'public' => 'nullable|bool',
            'parent_id' =>'nullable|numeric|exists:categories,id',
            'photo' => 'nullable|string',
            'description' => 'nullable|array'
        ];
    }


    public function getData()
    {
        return $this->only('id','title','plan_id','parent_id','public','photo','description');
    }
}
