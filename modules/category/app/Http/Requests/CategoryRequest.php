<?php

namespace Category\app\Http\Requests;

use Category\app\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Member\app\Models\User;

class CategoryRequest extends FormRequest
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
            //
        ];
    }
}
