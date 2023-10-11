<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('alta_proveedor');
    }
    public function rubro_created(): string
    {
        return view('rubro_created');
    }
    public function proveedor_created(): string 
    {
        return view('proveedor_exito');
    }
}
