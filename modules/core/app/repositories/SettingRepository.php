<?php


namespace Core\app\repositories;


use Core\app\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

class SettingRepository implements Repository
{
    /**
    * @var mixed|null
    */
    private $model;

    public function __construct(){
        $this->model = new Setting();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function fetch(string $id, array $relations,$field = null):Collection
    {
        return $this->where([$field ?? 'id'=>$id])
            ->with($relations)
            ->get();
    }

    public function model()
    {
        // TODO: Implement model() method.
    }

    public function all(): Collection
    {
        // TODO: Implement all() method.
    }

    public function create(array $params)
    {
        return $this->model->create($params);
    }

    public function update(int $id, array $params)
    {
        return $this->find($id)->update($params);
    }

    public function delete(int $id)
    {
        $this->find($id)->delete();
    }

    public function where(array $params)
    {
        return $this->model->where($params);
    }
}
