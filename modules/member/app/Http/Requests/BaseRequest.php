<?php


namespace Member\app\Http\Requests;


use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class BaseRequest extends FormRequest
{

    public function attributes()
    {
        return [
            'id' => 'آی دی',
            'plan_id'  => 'پلن',
            'mobile' => 'موبایل',
            'password' => 'پسورد',
            'verify_password' => 'تایید پسورد'
        ];

    }

/*    public function handleFile($name,$path,$params)
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
    }*/
}
