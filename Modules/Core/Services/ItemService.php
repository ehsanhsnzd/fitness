<?php


namespace Core\Services;


use Core\Models\Item;
use Core\repositories\ItemRepository;

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

    public function all()
    {
        return $this->repo->all()->toArray();
    }


    public function get($request)
    {
        return $this->repo->find($request['id'])->toArray();
    }

    public function set($request)
    {
        $item = $this->repo->create($request);
        foreach ($request['file'] as $file)
            $item->files()->create(['file'=>$file]);

        return $item->load('files')->toArray();
    }

    public function edit($request)
    {
        $this->repo->update($request['id'],$request);
        $item = $this->repo->find($request['id']);

        $item->files()->delete();

        foreach ($request['file'] as $file)
            $item->files()->create(['file'=>$file]);

        return [$item->load('files')->toArray()];
    }

    public function delete($request)
    {
        $this->repo->delete($request['id']);
    }


}
