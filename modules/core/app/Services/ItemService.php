<?php


namespace Core\app\Services;


use Core\app\Models\Item;
use Core\app\repositories\ItemRepository;

class ItemService
{

    /**
     * @var Item
     */
    private $repo;

    public function __construct()
    {
        $this->repo = new ItemRepository();
    }

    public function get($request)
    {
        return $this->repo->find($request['id'])->toArray();
    }

    public function set($request)
    {
        return $this->repo->create($request)->toArray();
    }

    public function edit($request)
    {
        return [
            $this->repo->update($request['id'],$request)
        ];
    }

    public function delete($request)
    {
        $this->repo->delete($request['id']);
    }


}
