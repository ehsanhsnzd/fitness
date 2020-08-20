<?php

namespace Member\app\Http\Requests\Item;

use Core\app\repositories\CategoryRepository;
use Core\app\repositories\ItemRepository;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class GetItemRequest extends FormRequest
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
        $this->repo = new ItemRepository();
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = $this->repo->find($this->id);

        if(!$this->user('users-api')->can('category.'.$item->category_id,$item->category_id))
            throw new AccessDeniedException('dont have access');
        else
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
            'id' => 'required|numeric|exists:categories,id'
        ];
    }

    public function all($keys =null)
    {
        return ['id' => app('request')->id];
    }
}
