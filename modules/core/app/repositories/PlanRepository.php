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

    public function fetch(string $id, array $relations):Collection
    {
        // TODO: Implement fetch() method.
    }

    public function model(int $id)
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
