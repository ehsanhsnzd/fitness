<?php


namespace Core\app\repositories;


use Core\app\Models\Plan;
use Illuminate\Database\Eloquent\Collection;

class PlanRepository implements Repository
{
    /**
     * @var Plan
     */
    private $model;

    public function __construct()
    {
        $this->model = new Plan();
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
        return $this->model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $params)
    {
        return $this->model->create($params);
    }

    public function update(int $id, array $params)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function where(array $params)
    {
       return $this->model->where($params);
    }
}
