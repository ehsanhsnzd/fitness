<?php


namespace Core\app\repositories;


use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class RoleRepository implements Repository
{
    protected $model;
    public function __construct()
    {
        $this->model = new Role();
    }
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function fetch(int $id, array $relations)
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
        // TODO: Implement create() method.
    }

    public function update(int $id,array $params)
    {
        $this->model->update($params);
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function where($param,$value)
    {
       return $this->model->where($param,$value);
    }
}
