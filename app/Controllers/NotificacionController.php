<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class NotificacionController extends BaseController
{
    public function index()
    {
        //
    }

    public function correoPrueba($destino)
    {
        // Lógica para enviar el correo electrónico aquí
        $email = \Config\Services::email();

        $email->setTo($destino);
        $email->setFrom('proyectojuntadepartamental@gmail.com', 'Asuntos internos');
        $email->setSubject('Notificación de prueba');
        $email->setMessage('Esto es un correo de prueba');

        if ($email->send()) {
            echo 'Correo enviado exitosamente';
        } else {
            echo $email->printDebugger();
        }
    }

    public function intervencionFinalizada($destino, $orden)
    {
        // Lógica para enviar el correo electrónico aquí
        $email = \Config\Services::email();

        $email->setTo($destino);
        $email->setFrom('proyectojuntadepartamental@gmail.com', 'Asuntos internos');
        $email->setSubject('Notificación de prueba');
        $email->setMessage('Esto es un correo de prueba');

        if ($email->send()) {
            echo 'Correo enviado exitosamente';
        } else {
            echo $email->printDebugger();
        }
    }
}
