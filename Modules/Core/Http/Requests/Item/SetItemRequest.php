<?php

namespace Core\Http\Requests\Item;

use Carbon\Carbon;
use Core\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class SetItemRequest extends BaseRequest
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
            'title' => 'required|string',
            'photo' => 'image|max:1024',
            'file.*' => 'file',
            'description' => 'string',
            'category_id'   => 'required|numeric|exists:categories,id'
        ];
    }


    public function getData()
    {
        $request =  $this->only('title','photo','attached','description','category_id');
        $request = $this->handleFile('photo','items',$request);
        $request = $this->handleMultiFile('file','items/file',$request);
        return $request;
    }

}
