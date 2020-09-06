<?php


namespace Core\Http\Controllers;


use Illuminate\Routing\Controller;
use Core\Exceptions\ExceptionHandler;

class BaseController extends Controller
{
    use ExceptionHandler;
}
