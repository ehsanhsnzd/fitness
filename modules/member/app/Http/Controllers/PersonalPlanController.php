<?php


namespace Member\app\Http\Controllers;


use Core\app\Http\Controllers\AbstractController;
use Core\app\repositories\BaseRepository;
use Member\app\Models\UserIndividualPlan;
use Member\app\Services\PersonalPlanService;

class PersonalPlanController extends AbstractController
{
    /**
    * @var mixed|null
    */
    protected $service;

    public function __construct($service = NULL){
        $this->service =
            new PersonalPlanService(UserIndividualPlan::class);
    }

}
