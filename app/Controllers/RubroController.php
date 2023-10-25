<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RubroModel;

class RubroController extends BaseController
{
    public function altaRubro()
    {
        // Si se ha enviado un formulario (POST)
        if ($this->request->getMethod() === 'post') {
            // Obtener los datos del formulario
            $data = [
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'saldo' => $this->request->getPost('presupuesto'),
            ];

            // Validar los datos si es necesario
            // Puedes agregar reglas de validación aquí

            // Insertar en la base de datos
            $rubroModel = new RubroModel();
            $rubroModel->insert($data);

            // Redirigir a una página de éxito o a la misma página
            // Puedes personalizar esta parte según tus necesidades

            return redirect()->to('/alta-proveedor/exito');
        }

        // Si no se ha enviado el formulario, cargar la vista
        return view('alta_rubro');
    }
}
