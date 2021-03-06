<?php


namespace Member\Repositories;


use Core\repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Member\Models\UserDedicatedPlan;

class DedicatedPlanRepository implements Repository
{
    /**
    * @var mixed|null
    */
    private $model;
    private $object;

    public function __construct(){
        $this->model = new UserDedicatedPlan();
    }

    public function find(int $id)
    {
        if(isset($this->object->id) && $this->object->id == $id)
           return $this->object = $this->object ?? $this->model->find($id);

        return $this->model->find($id);
    }

    public function fetch(string $id, array $relations): Collection
    {
        // TODO: Implement fetch() method.
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
        // TODO: Implement create() method.
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
        // TODO: Implement where() method.
    }

    public function findOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }
}
