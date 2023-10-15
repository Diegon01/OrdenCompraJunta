<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\OrdenDeCompraModel;

class OrdenDeCompraController extends BaseController
{
    public function index()
    {
        //
    }

    public function alta_orden_compra() {
        // Si se ha enviado un formulario (POST)
        if ($this->request->getMethod() === 'post') {
            // Obtener los datos del formulario
            $data = [
                'posibles_proveedores' => $this->request->getPost('posibles_proveedores'),
                'descripcion' => $this->request->getPost('descripcion'),
                'solicitante_id' => auth()->user()->id,
                'estado' => 'Pendiente',
            ];

            // Validar los datos si es necesario
            // Puedes agregar reglas de validación aquí

            // Insertar en la base de datos
            $ordenDeCompraModel = new OrdenDeCompraModel();
            $ordenDeCompraModel->insert($data);

            // Redirigir a una página de éxito o a la misma página
            // Puedes personalizar esta parte según tus necesidades

            return redirect()->to('/alta-proveedor/exito');
        }

        // Si no se ha enviado el formulario, cargar la vista
        return view('alta_proveedor');
    }
}
