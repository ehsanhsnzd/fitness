<?php


namespace Core\Services;


use Core\repositories\SettingRepository;

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
        $setting =$this->repo->where(['slug' => $name])
            ->first();

        return $setting ? $setting->value : false;
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

    public function editBySlug($slug,$data)
    {
       return $this->repo->where(['slug'=>$slug])->update($data);
    }

    public function delete($request)
    {
        $this->repo->delete($request->id);
    }

}
