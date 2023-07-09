<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $d = ['data' => 'Dashboard'];
        return view('dashboard', $d);
    }
}
