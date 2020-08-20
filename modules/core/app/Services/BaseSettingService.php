<?php


namespace Core\app\Services;


use Core\app\repositories\BaseSettingRepository;

class BaseSettingService
{
    /**
    * @var mixed|null
    */
    private $repo;

    public function __construct($repository = NULL){
        $this->repo = $repository ?? new BaseSettingRepository();
    }

    public function get($request)
    {
        return $this->repo->fetch($request->id,['nodes','settings'])->toArray();
    }

    public function getSlug($request)
    {
        return $this->repo->fetch($request->id,['nodes','settings'],'slug')->toArray();

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
