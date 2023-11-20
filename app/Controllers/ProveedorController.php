<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\ProveedorModel;

class ProveedorController extends BaseController
{
    public function index()
    {
        //
    }
    public function altaProveedor()
    {
        // Si se ha enviado un formulario (POST)
        if ($isContador || $isAdmin) {
            if ($this->request->getMethod() === 'post') {
                // Obtener los datos del formulario
                $data = [
                    'nombre' => $this->request->getPost('nombreProveedor'),
                    'persona_de_contacto' => $this->request->getPost('personaContacto'),
                    'numero_de_contacto' => $this->request->getPost('numeroContacto'),
                    'RUT' => $this->request->getPost('rut'),
                    'numero_de_cuenta' => $this->request->getPost('numeroCuenta'),
                    'fecha_de_vencimiento_dgi' => $this->request->getPost('fechaVencimientoDgi'),
                    'fecha_de_vencimiento_bps' => $this->request->getPost('fechaVencimientoBps'),
                    'rupe' => $this->request->getPost('rupe') ? 1 : 0,
                    'empresa_del_estado' => $this->request->getPost('empresaEstado') ? 1 : 0,
                ];

                // Validar los datos si es necesario
                // Puedes agregar reglas de validación aquí

                // Insertar en la base de datos
                $proveedorModel = new ProveedorModel();
                $proveedorModel->insert($data);

                // Redirigir a una página de éxito o a la misma página
                // Puedes personalizar esta parte según tus necesidades

                return redirect()->to('/alta-proveedor/exito');
            }
        }
        else {
            return redirect()->to('/permission-denied');
        }

        // Si no se ha enviado el formulario, cargar la vista
        return view('alta_proveedor');
    }

    public function editProv()
    {
        // Si se ha enviado un formulario (POST)
        if ($this->request->getMethod() === 'post') {
            // Obtener los datos del formulario

            $id = $this->request->getPost('idProveedor');
            $persona_de_contacto = $this->request->getPost('personaContacto');
            $numero_de_contacto = $this->request->getPost('numeroContacto');
            $numero_de_cuenta = $this->request->getPost('numeroCuenta');
            $fecha_de_vencimiento_dgi = $this->request->getPost('fechaVencimientoDgi');
            $fecha_de_vencimiento_bps = $this->request->getPost('fechaVencimientoBps');
            $rupe = $this->request->getPost('rupe') ? 1 : 0;
            $empresa_del_estado = $this->request->getPost('empresaEstado') ? 1 : 0;

            // Insertar en la base de datos
            $provModel = new ProveedorModel();
            $proveedor = $provModel->find($id);
            $provModel->update($id, ['persona_de_contacto' => $persona_de_contacto]);
            $provModel->update($id, ['numero_de_contacto' => $numero_de_contacto]);
            $provModel->update($id, ['numero_de_cuenta' => $numero_de_cuenta]);
            $provModel->update($id, ['fecha_de_vencimiento_dgi' => $fecha_de_vencimiento_dgi]);
            $provModel->update($id, ['fecha_de_vencimiento_bps' => $fecha_de_vencimiento_bps]);
            $provModel->update($id, ['rupe' => $rupe]);
            $provModel->update($id, ['empresa_del_estado' => $empresa_del_estado]);

            // Redirigir a una página de éxito o a la misma página
            // Puedes personalizar esta parte según tus necesidades

            return redirect()->to('/alta-proveedor/exito');
        }

        // Si no se ha enviado el formulario, cargar la vista
        return view('alta_rubro');
    }
}
