<?php

namespace Core\app\Http\Requests\Item;

use Core\app\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class GetItemRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:items,id'
        ];
    }

    public function all($keys =null)
    {
        return ['id' => app('request')->id];
    }
}
