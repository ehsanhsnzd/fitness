<?php

namespace Member\Http\Requests\Item;

use Core\repositories\CategoryRepository;
use Core\repositories\ItemRepository;
use Illuminate\Foundation\Http\FormRequest;
use Member\Http\Requests\BaseRequest;

class PhotoItemRequest extends BaseRequest
{
    /**
     * @var CategoryRepository
     */
//    private $repo;
//    private $categoryRepo;
//
//    public function __construct()
//    {
//        $this->repo = new ItemRepository();
//        $this->categoryRepo = new CategoryRepository();
//    }
//
//    /**
//     * Determine if the user is authorized to make this request.
//     *
//     * @return bool
//     */
//    public function authorize()
//    {
//        $item = $this->repo->find($this->id);
//        $category = $this->categoryRepo->find($item->category_id);
//        return $this->user('users-api')->can('getCategory',$category);
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }

    public function all($keys =null)
    {
        return ['id' => app('request')->id];
    }
}
