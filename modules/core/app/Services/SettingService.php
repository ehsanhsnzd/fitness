<?php


namespace Core\app\Services;


use Core\app\repositories\SettingRepository;

class SettingService
{
    /**
    * @var mixed|null
    */
    private $repo;

    public function __construct($repository = NULL){
        $this->repo = $repository ?? new SettingRepository();
    }

    public function get($request)
    {
        return $this->repo->fetch($request->id,['nodes'])->toArray();
    }

    public function getSlug($request)
    {
        return $this->repo->fetch($request->id,['nodes'],'slug')->toArray();

    }

    public function name($name)
    {
        return $this->repo->where(['slug' => $name])
            ->first()
            ->value;
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
        $this->repo->delete($request->id);
    }

}
