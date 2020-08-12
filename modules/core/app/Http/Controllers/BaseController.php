<?php


namespace Core\app\Http\Controllers;


use Illuminate\Routing\Controller;
use Core\app\Exceptions\ExceptionHandler;

class BaseController extends Controller
{
    use ExceptionHandler;
}
