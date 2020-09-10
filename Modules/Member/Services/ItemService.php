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
        return $this->repo->fetch($request['id'],
            [
                'files'=>function($query){$query->select('item_id','file');}
            ]

        )->toArray();
    }

    public function photo($request)
    {

//        $photo = $this->repo->find($request['id'])->photo;
        return storage_path('app/items/' . $request['id']);
    }

    public function file($request)
    {

//        $file = $this->repo->find($request['id'])
//            ->files()
//            ->first()
//            ->file;

        return storage_path('app/items/file/' . $request['id']);
    }

    public function files($request)
    {

//        $file = $this->repo->find($request['id'])
//            ->files()
//            ->find($request['file_id'])
//            ->file;

        return storage_path('app/items/file/' . $request['id']);
    }
}
