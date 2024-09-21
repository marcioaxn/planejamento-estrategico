<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index($ano = '')
    {
        return view('welcome',['ano' => $ano]);
    }
}
