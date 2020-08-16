<?php


namespace Trainer\app\Services;


use Core\app\repositories\RoleRepository;
use Trainer\app\Models\Trainer;

class RoleService
{
    /**
     * @var RoleRepository
     */
    private $repo;

    public function __construct($repo= null)
    {
        $this->repo = $repo ?? new RoleRepository();
    }

    public function get($request)
    {
        return $this->repo->find($request->id)->toArray();
    }


}
