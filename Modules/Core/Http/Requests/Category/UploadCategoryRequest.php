<?php

namespace Core\Http\Requests\Category;

use Core\Http\Requests\BaseRequest;

class UploadCategoryRequest extends BaseRequest
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
            'photo' => 'required|image|max:1024',
        ];
    }


    public function getData()
    {
        $request = $this->only('photo');
        $request = $this->handleFile('photo','public/category',$request);
        return $request;
    }
}
