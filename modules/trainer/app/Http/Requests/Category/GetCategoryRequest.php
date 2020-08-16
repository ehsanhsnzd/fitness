<?php

namespace Trainer\app\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class GetCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return $this->user('users')->can('getCategory',Category::class);
        return $this->user('users')->can('category_'.$this->id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:categories,id'
        ];
    }

    public function all($keys =null)
    {
        return ['id' => app('request')->id];
    }
}
