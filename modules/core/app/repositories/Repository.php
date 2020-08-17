<?php


namespace Core\app\repositories;



use Illuminate\Database\Eloquent\Collection;

interface Repository
{

    /**
     * @param int $id
     * @return Collection
     */
    public function find(int $id);

    /**
     * @param int $id
     * @param array $relations
     * @return mixed
     */
    public function fetch(int $id,array $relations);

    /**
     * @param int $id
     * @return mixed
     */
    public function model(int $id);

    /**
     * @return Collection
     */
    public function all():Collection;

    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params);

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function update(int $id,array $params);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);


    /**
     * @param array $params
     * @return mixed
     */
    public function where(array $params);
}
