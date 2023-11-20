<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RubroModel;
use App\Models\RubroSaldoCongeladoModel;

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

            $congelado_data = [
                'codigo' => $this->request->getPost('codigo'),
                'saldo_congelado' => 0,
            ];

            // Validar los datos si es necesario
            // Puedes agregar reglas de validación aquí

            // Insertar en la base de datos
            $rubroModel = new RubroModel();
            $rubroModel->insert($data);

            $rubroconModel = new RubroSaldoCongeladoModel();
            $rubroconModel->insert($congelado_data);

            // Redirigir a una página de éxito o a la misma página
            // Puedes personalizar esta parte según tus necesidades

            return redirect()->to('/alta-proveedor/exito');
        }

        // Si no se ha enviado el formulario, cargar la vista
        return view('alta_rubro');
    }

    public function editRubro()
    {
        // Si se ha enviado un formulario (POST)
        if ($this->request->getMethod() === 'post') {
            // Obtener los datos del formulario

            $codigo = $this->request->getPost('codigo');
            $nombre = $this->request->getPost('nombre');
            $saldo = $this->request->getPost('presupuesto');
            $saldo_congelado = $this->request->getPost('presupuestoc');

            // Validar los datos si es necesario
            // Puedes agregar reglas de validación aquí
            $notificacionController = new \App\Controllers\NotificacionController();
            $logged_user_id = auth()->user()->id;
            $userModel_orden = new \App\Models\UserModelo();
            $logged_user = $userModel_orden
                    ->join('auth_identities', 'auth_identities.user_id = users.id')
                    ->join('user_roles', 'user_roles.user_id = users.id')
                    ->find($logged_user_id);
            $correo_logged = $logged_user->secret;
            $nombres_logged = $logged_user->nombres;
            $apellidos_logged = $logged_user->apellidos;
            $presis = $userModel_orden
                ->join('auth_identities', 'auth_identities.user_id = users.id')
                ->join('user_roles', 'user_roles.user_id = users.id')
                ->where('Presidente', 1)
                ->findAll();
            $admins = $userModel_orden
                ->join('auth_identities', 'auth_identities.user_id = users.id')
                ->join('user_roles', 'user_roles.user_id = users.id')
                ->where('Admin', 1)
                ->findAll();

            // Insertar en la base de datos
            $rubroModel = new RubroModel();
            $rubro = $rubroModel->find($codigo);
            $nombre_old = $rubro['nombre'];
            $saldo_old = $rubro['saldo'];
            $rubroModel->update($codigo, ['nombre' => $nombre]);
            $rubroModel->update($codigo, ['saldo' => $saldo]);

            $rubroconModel = new RubroSaldoCongeladoModel();
            $rubro_con = $rubroconModel->find($codigo);
            $saldo_con_old = $rubro_con['saldo_congelado'];
            $rubroconModel->update($codigo, ['saldo_congelado' => $saldo_congelado]);

            foreach ($presis as $presi) {
                $destino = $presi->secret;
                $notificacionController->rubroEditado($destino, $nombres_logged, $apellidos_logged, $correo_logged, $codigo, $nombre, $saldo, $saldo_congelado, $nombre_old, $saldo_old, $saldo_con_old);
            }
            foreach ($admins as $admin) {
                $destino = $admin->secret;
                $notificacionController->rubroEditado($destino, $nombres_logged, $apellidos_logged, $correo_logged, $codigo, $nombre, $saldo, $saldo_congelado, $nombre_old, $saldo_old, $saldo_con_old);
            }

            // Redirigir a una página de éxito o a la misma página
            // Puedes personalizar esta parte según tus necesidades

            return redirect()->to('/alta-proveedor/exito');
        }

        // Si no se ha enviado el formulario, cargar la vista
        return view('alta_rubro');
    }
}
