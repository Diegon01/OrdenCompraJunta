<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('crear_rubro');
    }
    public function rubro_created(): string
    {
        return view('rubro_created');
    }
}
