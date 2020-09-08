<?php
namespace Member\Services;



use Core\repositories\CategoryRepository;

class CategoryService
{
    private $repo;

    public function __construct( $repository = null)
    {
        $this->repo = $repository ?? new CategoryRepository();
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

        $subCategories = $category->first()->nodes()->get();

        $category = $this->allItems($category->first(),$subCategories);
        $category->put('nodes',$this->hasAccess($subCategories));



        return
            $category->toArray();
    }


    public function allItems($category,$subCategories)
    {
        $allItems = collect($subCategories)->reduce(function($arr, $category) {
            if($arr==null)
                $arr = collect($arr);

            return $arr->merge($category->items()->get());
        });
        return $categories = collect($category)->put('allItems',$allItems) ;
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
