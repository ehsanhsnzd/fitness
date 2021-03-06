<?php
namespace Member\Services;



use Core\Models\Category;
use Core\Models\Item;
use Core\repositories\CategoryRepository;

class CategoryService
{
    private $repo;
    private $user;

    public function __construct( $repository = null)
    {
        $this->repo = $repository ?? new CategoryRepository();
        $this->user = auth('users-api')->user();
    }

    public function all()
    {
        $categories = $this->repo->fetch(null,['nodes','items'],'parent_id');
        $categories = $this->extractDescription($categories);

        return
            $categories->toArray();
    }

    /** get category by id
     * @param $request
     * @return array
     */
    public function get($request)
    {
        $category = $this->repo->fetch($request['id'],['nodes','items']);
        $category = $this->extractDescription($category);

        return
            $category->first()->toArray();
    }


    /** get with all items
     * @param $request
     * @return array
     */
    public function getWithAllItems($request)
    {
        $category = $this->repo->fetch($request['id'],['nodes','items']);
        $category = $this->extractDescription($category);


        $subCategories = $category->first()->nodes()->get();
        $category = collect($category->first())->put('items',$this->allItems($subCategories));


        return
            $category->toArray();
    }


    public function allItems($subCategories)
    {
        return collect($subCategories)->reduce(function($arr, $category) {
            if($arr==null)
                $arr = collect($arr);

            return $arr->merge($category->items()->get());
        });

    }

    public function hasAccess(\Illuminate\Support\Collection $categories)
    {
        return collect($categories)->map(function($category) {
            $category->access = $this->user->can('category.'.$category->id);
            return $category;
        });

    }

    public function extractDescription($categories)
    {
        return collect($categories)->map(function ($cat){
            $cat->description = json_decode($cat->description);
            return $cat;
        });
    }

}
