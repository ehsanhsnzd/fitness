<?php

namespace Member\app\Http\Requests\Category;

use Core\app\repositories\CategoryRepository;
use Illuminate\Foundation\Http\FormRequest;
use Member\app\Http\Requests\BaseRequest;

class GetCategoryRequest extends BaseRequest
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
        return $this->user('users-api')->can('getCategory',$this->repo->find($this->id));
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
