<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('login');
    }
    public function rubro_created(): string
    {
        return view('rubro_created');
    }
}
