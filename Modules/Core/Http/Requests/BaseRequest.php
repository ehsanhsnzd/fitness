<?php


namespace Core\Http\Requests;


use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class BaseRequest extends FormRequest
{

    public function attributes()
    {
        return [
            'id' => 'آی دی',
            'title' => 'رو نوشت',
            'plan_id'  => 'پلن',
            'public' => 'عمومی',
            'photo' => 'عکس',
            'description' => 'متن',
            'expire_days' => 'روزهای انقضا',
            'default' => 'پیشفرض',
            'attached' => 'فایل',
            'category_id'   => 'آی دی دسته بندی'
        ];

    }


    public function handleFile($name,$path,$params)
    {
        if($this->hasFile($name)) {
            $file = $this->file($name);
            $fileName = $file->getClientOriginalName();
            $fileName = base64_encode(Carbon::now()->timestamp . $fileName);
            Storage::disk('local')
                ->putFileAs($path, $file,$fileName);

            $params[$name] = $fileName;
        }
        return $params;
    }


    public function handleMultiFile($name,$path,$params)
    {
        if($this->hasFile($name)) {
            $file = $this->file($name);

                foreach ($file as $key=>$value) {
                    $fileName = $value->getClientOriginalName();
                    $fileName =base64_encode( Carbon::now()->timestamp . $fileName.$key);
                    Storage::disk('local')
                        ->putFileAs($path, $value, $fileName);
                    $params[$name][$key] = $fileName;
                }
        }
        return $params;
    }
}
