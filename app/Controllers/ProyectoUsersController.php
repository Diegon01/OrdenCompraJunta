<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProyectoUser;
use CodeIgniter\Shield\Entities\User;

class ProyectoUsersController extends BaseController
{
    public function index()
    {
        //
    }

    public function altaUsuario()
    {
        // Si se ha enviado un formulario (POST)
        if ($this->request->getMethod() === 'post') {
            // Obtener los datos del formulario
            $data = [
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'password_confirm' => $this->request->getPost('password_confirm'),
                'nombre' => $this->request->getPost('nombre'),
                'apellido' => $this->request->getPost('apellido'),
                'cedula' => $this->request->getPost('cedula'),
            ];

            // Insertar en la base de datos
            $proyectoUser = new ProyectoUser();

            // Especificar la tabla correcta
            $proyectoUser->from = 'proyecto_users';
            $proyectoUser->table('proyecto_users');
            $proyectoUser->insert($data);

            // Redirigir a una página de éxito o a la misma página
            // Puedes personalizar esta parte según tus necesidades

            return redirect()->to('/alta-proveedor/exito');
        }

        // Si no se ha enviado el formulario, cargar la vista
        return view('alta_proveedor');
    }
}
