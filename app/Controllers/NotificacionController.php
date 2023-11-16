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
        $email->setFrom('proyectojuntadepartamental@gmail.com', 'Junta departamental - Asuntos internos');
        $email->setSubject('Intervención realizada para Solicitud Nº ' . $orden);
        $email->setMessage('Se ha realizado la intervención de la solicitud Nº ' . $orden . '. Esperando aprobación del Presidente.');
        $email->send();
    }

    public function pendienteOfertas($destino, $orden)
    {
        // Lógica para enviar el correo electrónico aquí
        $email = \Config\Services::email();

        $email->setTo($destino);
        $email->setFrom('proyectojuntadepartamental@gmail.com', 'Junta departamental - Asuntos internos');
        $email->setSubject('Pendiente de recibir ofertas para Solicitud Nº ' . $orden);
        $email->setMessage('El Presidente ha aprobado proseguir con la solicitud Nº ' . $orden . '. Se trata de una LICITACIÓN, por lo que un contador o contadora debe realizar la publicación y recibir ofertas de los proveedores.');
        $email->send();
    }

    public function pendienteCotizar($destino, $orden)
    {
        // Lógica para enviar el correo electrónico aquí
        $email = \Config\Services::email();

        $email->setTo($destino);
        $email->setFrom('proyectojuntadepartamental@gmail.com', 'Junta departamental - Asuntos internos');
        $email->setSubject('Pendiente de buscar cotizaciones para Solicitud Nº ' . $orden);
        $email->setMessage('El Presidente ha aprobado proseguir con la solicitud Nº ' . $orden . '. Se trata de una COMPRA DIRECTA, por lo que el solicitante debe conseguir cotizaciones de los proveedores.');
        $email->send();
    }

    public function presidenteRechaza($destino, $orden)
    {
        // Lógica para enviar el correo electrónico aquí
        $email = \Config\Services::email();

        $email->setTo($destino);
        $email->setFrom('proyectojuntadepartamental@gmail.com', 'Junta departamental - Asuntos internos');
        $email->setSubject('Solicitud Nº ' . $orden . ' rechazada');
        $email->setMessage('El Presidente ha rechazado proseguir con la solicitud Nº ' . $orden);
        $email->send();
    }

    public function pendienteElegirOferta($destino, $orden)
    {
        // Lógica para enviar el correo electrónico aquí
        $email = \Config\Services::email();

        $email->setTo($destino);
        $email->setFrom('proyectojuntadepartamental@gmail.com', 'Junta departamental - Asuntos internos');
        $email->setSubject('Pendiente elegir un proveedor para Solicitud Nº ' . $orden);
        $email->setMessage('Se han ingresado los precios ofrecidos por los proveedores para la solicitud Nº ' . $orden . '. El Presidente debe proceder a elegir un proveedor definitivo.');
        $email->send();
    }

    public function ordenCompraEmitida($destino, $orden, $ordenfinal)
    {
        // Lógica para enviar el correo electrónico aquí
        $email = \Config\Services::email();

        $email->setTo($destino);
        $email->setFrom('proyectojuntadepartamental@gmail.com', 'Junta departamental - Asuntos internos');
        $email->setSubject('Se ha emitido la Órden de Compra Nº ' . $ordenfinal);
        $email->setMessage('Se ha elegido un proveedor definitivo para la solicitud Nº ' . $orden . '. Se ha emitido la Órden de Compra Nº ' . $ordenfinal . ' con la información establecida. Queda pendiente el visto del Secretario.');
        $email->send();
    }

    public function ordenCompraVisto($destino, $orden)
    {
        // Lógica para enviar el correo electrónico aquí
        $email = \Config\Services::email();

        $email->setTo($destino);
        $email->setFrom('proyectojuntadepartamental@gmail.com', 'Junta departamental - Asuntos internos');
        $email->setSubject('Está lista la Órden de Compra Nº ' . $orden);
        $email->setMessage('El Secretario ha dado el visto a la Órden de Compra Nº ' . $orden . '. La órden de compra se encuentra emitida y lista.');
        $email->send();
    }

    public function notificarUsuarioCreado($destino, $pass) {
        // Lógica para enviar el correo electrónico aquí
        $email = \Config\Services::email();

        $email->setTo($destino);
        $email->setFrom('proyectojuntadepartamental@gmail.com', 'Junta departamental - Asuntos internos');
        $email->setSubject('Usuario registrado exitosamente');
        $email->setMessage('Se ha registrado el usuario y asignado automáticamente la siguiente contraseña: "' . $pass . '" (sin comillas). Se puede cambiar la contraseña dentro del sistema, en la pestaña de "Cambiar contraseña".');
        $email->send();
    }
}
