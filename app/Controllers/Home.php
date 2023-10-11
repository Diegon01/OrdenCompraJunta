<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function rubro_created(): string
    {
        return view('rubro_created');
    }
    public function proveedor_created(): string 
    {
        return view('proveedor_exito');
    }
    public function proveedor_crear(): string 
    {
        return view('alta_proveedor');
    }
}
