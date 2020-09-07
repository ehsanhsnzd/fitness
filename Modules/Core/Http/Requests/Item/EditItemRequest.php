<?php

namespace Core\Http\Requests\Item;

use Carbon\Carbon;
use Core\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class EditItemRequest extends BaseRequest
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
            'id'    =>  'required|numeric',
            'title' => 'string',
            'photo' => 'image|max:1024',
            'file.*' => 'file',
            'description' => 'string',
            'category_id'   => 'required|numeric|exists:categories,id'

        ];
    }


    public function getData()
    {
        $request =  $this->only('id','title','photo','attached','description','category_id');
        $request = $this->handleFile('photo','items',$request);
        $request = $this->handleMultiFile('file','items/file',$request);
        return $request;
    }


    public function handleFile($name,$path,$params)
    {
        if($this->hasFile($name)) {
            $file = $this->file($name);
            $fileName = $file->getClientOriginalName();
            $fileName = Carbon::now()->timestamp . $fileName;
            Storage::disk('local')
                ->putFileAs($path, $file,$fileName);

            $params[$name] = $fileName;
        }
        return $params;
    }
}
