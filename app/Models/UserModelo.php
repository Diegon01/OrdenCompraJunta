<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModelo extends ShieldUserModel
{
    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,

            'profile_pic',
        ];
    }

    public function isAdmin()
    {
        // Get the user ID
        $userId = auth()->user()->id;

        // Get the database service via dependency injection
        $db = \Config\Database::connect();

        // Assuming you have a "user_roles" table and "Admin" role column
        $result = $db->table('user_roles')
            ->where('user_id', $userId)
            ->where('Admin', 1)
            ->get();

        // Check if there is a row with the "Admin" role set as "1" for the user
        if ($result->getNumRows() > 0) {
            return true; // User is an admin
        } else {
            return false; // User is not an admin
        }
    }

    public function isFuncionario()
    {
        // Get the user ID
        $userId = auth()->user()->id;

        // Get the database service via dependency injection
        $db = \Config\Database::connect();

        // Assuming you have a "user_roles" table and "Admin" role column
        $result = $db->table('user_roles')
            ->where('user_id', $userId)
            ->where('Funcionario', 1)
            ->get();

        // Check if there is a row with the "Admin" role set as "1" for the user
        if ($result->getNumRows() > 0) {
            return true; // User is an admin
        } else {
            return false; // User is not an admin
        }
    }

    public function isContador()
    {
        // Get the user ID
        $userId = auth()->user()->id;

        // Get the database service via dependency injection
        $db = \Config\Database::connect();

        // Assuming you have a "user_roles" table and "Admin" role column
        $result = $db->table('user_roles')
            ->where('user_id', $userId)
            ->where('Contador', 1)
            ->get();

        // Check if there is a row with the "Admin" role set as "1" for the user
        if ($result->getNumRows() > 0) {
            return true; // User is an admin
        } else {
            return false; // User is not an admin
        }
    }

    public function isPresidente()
    {
        // Get the user ID
        $userId = auth()->user()->id;

        // Get the database service via dependency injection
        $db = \Config\Database::connect();

        // Assuming you have a "user_roles" table and "Admin" role column
        $result = $db->table('user_roles')
            ->where('user_id', $userId)
            ->where('Presidente', 1)
            ->get();

        // Check if there is a row with the "Admin" role set as "1" for the user
        if ($result->getNumRows() > 0) {
            return true; // User is an admin
        } else {
            return false; // User is not an admin
        }
    }

    public function isSecretario()
    {
        // Get the user ID
        $userId = auth()->user()->id;

        // Get the database service via dependency injection
        $db = \Config\Database::connect();

        // Assuming you have a "user_roles" table and "Admin" role column
        $result = $db->table('user_roles')
            ->where('user_id', $userId)
            ->where('Secretario', 1)
            ->get();

        // Check if there is a row with the "Admin" role set as "1" for the user
        if ($result->getNumRows() > 0) {
            return true; // User is an admin
        } else {
            return false; // User is not an admin
        }
    }
}
