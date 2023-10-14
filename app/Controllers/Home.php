<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function proveedor_created(): string 
    {
        return view('proveedor_exito');
    }
    public function proveedor_crear(): string 
    {
        return view('alta_proveedor');
    }
    public function orden_compra_crear(): string 
    {
        return view('alta_ordenCompra');
    }
    public function usuario_crear(): string 
    {
        return view('alta_usuario');
    }
    public function registrar_created(): string 
    {
        return view('registro_exito');
    }
    public function ver_ordenes(): string 
    {
        return view('ABM_Ordenes');
    }
}
