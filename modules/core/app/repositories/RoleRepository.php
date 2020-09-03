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

    public function fetch(string $id, array $relations):Collection
    {
        // TODO: Implement fetch() method.
    }

    public function model()
    {
        // TODO: Implement model() method.
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $params)
    {
        return $this->model->create($params);
    }

    public function update(int $id,array $params)
    {
        $this->model->update($params);
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
