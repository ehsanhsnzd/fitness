<?php


namespace Category\app\repositories;


use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements Repository
{

    /**
     * @var Permission
     */
    private $model;

    public function __construct()
    {
        $this->model = new Permission();
    }

    public function find(int $id): Collection
    {
        // TODO: Implement find() method.
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
        return $this->model->create($params);
    }

    public function update(int $id,array $params)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function where(string $param, $value): Collection
    {
        // TODO: Implement where() method.
    }
}
