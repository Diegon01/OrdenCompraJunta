<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProyectoUser;
use CodeIgniter\Shield\Entities\User;

class ProyectoUsers extends BaseController
{
    public function index()
    {
        //
    }

    function crearUsuario($nombre, $apellido, $cedula, $email, $otrosDatos = [])
    {
        // Crea una instancia de ProyectoUser
        $usuarioModel = new ProyectoUser();

        // Define los datos del usuario
        $datosUsuario = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'cedula' => $cedula,
            'email' => $email,
        ];

        // Combinar los datos adicionales proporcionados
        $datosUsuario = array_merge($datosUsuario, $otrosDatos);

        // Crea una entidad de usuario con los datos
        $usuario = new User($datosUsuario);

        // Inserta el usuario en la base de datos
        $usuarioModel->insert($usuario);

        // Retorna el ID del usuario recién creado
        return $usuarioModel->getInsertID();
    }
}
