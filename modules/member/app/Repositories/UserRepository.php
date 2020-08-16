<?php


namespace Member\app\Repositories;


use Core\app\repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Member\app\Models\User;

class UserRepository implements Repository
{
    /**
     * @var User
     */
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function find(int $id)
    {
        $this->model->find($id);
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

    public function update(int $id, array $params)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function where(string $param, $value)
    {
        // TODO: Implement where() method.
    }
}
