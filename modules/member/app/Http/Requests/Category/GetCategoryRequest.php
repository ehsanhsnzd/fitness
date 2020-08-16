<?php

namespace Member\app\Http\Requests\Category;

use Core\app\repositories\CategoryRepository;
use Illuminate\Foundation\Http\FormRequest;

class GetCategoryRequest extends FormRequest
{
    /**
     * @var CategoryRepository
     */
    private $repo;

    /**
     * GetCategoryRequest constructor.
     */
    public function __construct()
    {
        $this->repo = new CategoryRepository();
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $category = $this->repo->find($this->id);
        if(isset($category) && $category->public)
            return true;

        return $this->user('users-api')->can('category.'.$this->id,$this->id);
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
