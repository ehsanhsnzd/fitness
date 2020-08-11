<?php


namespace Member\app\Services;


use Illuminate\Support\Facades\Auth;
use Member\app\Models\User;

class PlanService
{
    public function assign($request)
    {
        $user = User::find($request->user_id);
        $user->assignRole($request->plan);
    }

    public function remove()
    {

    }
}
