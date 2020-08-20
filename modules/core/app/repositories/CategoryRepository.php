<?php


namespace Core\app\repositories;


use Core\app\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements Repository
{
    protected $model;
    public function __construct($category = null)
    {
        $this->model = $category ?? new Category();
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->model->create($params);
    }

    /**
     * @param int $id
     * @param array $params
     * @return
     */
    public function update(int $id,array $params)
    {
        return $this->find($id)->update($params);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->find($id)->delete();
    }

    /**
     * @param int $id
     * @param array $relations
     * @return mixed
     */
    public function fetch(string $id, array $relations):Collection
    {
        return $this->model->where('id',$id)
            ->with($relations)
            ->get();
    }

    /**
     * @param int $id
     * @return Category
     */
    public function model(int $id)
    {
        return $this->model;
    }

    public function where(array $params): Collection
    {
        // TODO: Implement where() method.
    }
}
