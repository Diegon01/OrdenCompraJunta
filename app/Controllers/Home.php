<?php

namespace App\Controllers;
use App\Models\OrdenDeCompraModel;
use CodeIgniter\Pager\Pager;

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
    public function solicitud_orden_compra_crear(): string 
    {
        return view('alta_solicitudOrdenCompra');
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
         // Cargar el modelo
         $ordenCompraModel = new \App\Models\OrdenDeCompraModel();

         // Configurar la paginación
         $pager = \Config\Services::pager();
         $page = $this->request->getVar('page') ?? 1; // Obtener el número de página de la URL
 
         $perPage = 8; // Número de resultados por página
         $totalResults = $ordenCompraModel->countAll(); // Obtener el total de resultados
 
         // Obtener las órdenes de compra para la página actual
         $ordenes = $ordenCompraModel->paginate($perPage, 'default', $page);
         $data = [
             'ordenes' => $ordenes,
             'pager' => $ordenCompraModel->pager,
         ];
 
         return view('ABM_Ordenes', $data);
    }
    public function a(): string 
    {
        return view('a');
    }
}
