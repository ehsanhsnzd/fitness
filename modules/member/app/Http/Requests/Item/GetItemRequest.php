<?php

namespace Member\app\Http\Requests\Item;

use Core\app\repositories\CategoryRepository;
use Core\app\repositories\ItemRepository;
use Illuminate\Foundation\Http\FormRequest;
use Member\app\Http\Requests\BaseRequest;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class GetItemRequest extends BaseRequest
{
    /**
     * @var CategoryRepository
     */
    private $repo;
    private $categoryRepo;
    /**
     * GetCategoryRequest constructor.
     */
    public function __construct()
    {
        $this->repo = new ItemRepository();
        $this->categoryRepo = new CategoryRepository();
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = $this->repo->find($this->id);
        $category = $this->categoryRepo->find($item->category_id);
        return $this->user('users-api')->can('getCategory',$category);
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
