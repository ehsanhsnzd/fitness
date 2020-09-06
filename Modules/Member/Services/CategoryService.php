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

    /** get category by id
     * @param $request
     * @return array
     */
    public function get($request)
    {
        $categories = $this->repo->fetch($request->id,['nodes']);

        return $categories->toArray();
    }

}
