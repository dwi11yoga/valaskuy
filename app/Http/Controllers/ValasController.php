<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValasController extends Controller
{
    //Home
    public function index()
    {
        return view('home', [
            'title'=>'Selamat datang di ValasKuy!'
        ]);
    }
}
