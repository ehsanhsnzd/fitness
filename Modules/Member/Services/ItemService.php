<?php


namespace Member\Services;


use Core\repositories\ItemRepository;

class ItemService
{
    /**
    * @var mixed|null
    */
    private $repo;

    public function __construct($repository = NULL){
        $this->repo = $repository ?? new ItemRepository();
    }

    public function get($request)
    {
        return $this->repo->find($request['id'])->toArray();
    }

    public function media($request)
    {

        $photo = $this->repo->find($request['id'])->photo;
        return storage_path('app/items/' . $photo);
    }

    public function file($request)
    {

        $file = $this->repo->find($request['id'])
            ->files()
            ->first()
            ->file;

        return storage_path('app/items/file/' . $file);
    }

    public function files($request)
    {

        $file = $this->repo->find($request['id'])
            ->files()
            ->find($request['file_id'])
            ->file;

        return storage_path('app/items/file/' . $file);
    }
}
