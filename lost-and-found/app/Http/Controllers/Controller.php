<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController; // This is the key line!

abstract class Controller extends BaseController // And this line too!
{
    use AuthorizesRequests, ValidatesRequests;
}