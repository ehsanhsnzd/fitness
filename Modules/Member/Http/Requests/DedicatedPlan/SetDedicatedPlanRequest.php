<?php

namespace Member\Http\Requests\DedicatedPlan;

use Illuminate\Foundation\Http\FormRequest;
use Member\Repositories\DedicatedPlanRepository;

class SetDedicatedPlanRequest extends FormRequest
{
    /**
    * @var mixed|null
    */
    private $repo;

    public function __construct($repository = NULL){
        $this->repo = $repository ?? new DedicatedPlanRepository();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user('users-api')->can('getDedicatedPlan',$this->repo->find($this->id));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:user_dedicated_plans,id'
        ];
    }

    public function all($keys =null)
    {
        return [
            'id' => app('request')->id,
            'repo' => $this->repo
        ];
    }
}
