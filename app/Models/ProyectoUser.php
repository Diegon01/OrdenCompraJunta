<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class ProyectoUser extends ShieldUserModel
{
    protected $table = 'proyecto_users';
    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,

            'nombre',
            'apellido',
            'cedula',
        ];
    }
}
