<?php


namespace Core\app\repositories;


use Illuminate\Database\Eloquent\Builder;
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

    public function where(array $params):Builder
    {
        return $this->model->where($params);
    }
}
