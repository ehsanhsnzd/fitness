<?php


namespace Member\Services;


use Member\Repositories\ProfileRepository;

class ProfileService
{
    /**
     * @var ProfileRepository
     */
    private $repo;
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    public function __construct()
    {
        $this->repo = new ProfileRepository();
        $this->user = auth()->guard('users-api')->user();

    }

    public function update($request)
    {
         $this->user->profile()->update($request);
         return $this->user->profile()->first()->toArray();
    }
}
