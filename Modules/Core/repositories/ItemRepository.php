<?php


namespace Core\repositories;


use Core\Models\Item;
use Illuminate\Database\Eloquent\Collection;

class ItemRepository implements Repository
{

    /**
     * @var ItemRepository
     */
    private $model;

    public function __construct()
    {
        $this->model = new Item();
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
