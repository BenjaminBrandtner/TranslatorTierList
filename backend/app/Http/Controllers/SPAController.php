<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class SPAController extends Controller
{
    public function index(string $route = '')
    {
        View::addExtension('html', 'php');
        return view('index');
    }
}
