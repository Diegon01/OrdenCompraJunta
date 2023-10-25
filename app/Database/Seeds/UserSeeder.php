<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {

        $data_user = [
            'username' => 'admin.publico',
            'nombres' => 'Administrador',
            'apellidos' => 'Publico',
            'cedula' => '1234567890',
            // Add more user data as needed
        ];

        $this->db->table('users')->insert($data_user);

        $userID = $this->db->insertID();

        // Original password (unhashed)
        $originalPassword = 'admin'; // Replace this with the actual password

        // Hash the password using password_hash
        $hashedPassword = password_hash($originalPassword, PASSWORD_BCRYPT);

        $data_identity = [
            'user_id' => $userID,
            'type' => 'email_password',
            'secret' => 'admin@publico.com',
            'secret2' => $hashedPassword, // Insert the hashed password
            'force_reset' => 1,
        ];

        $this->db->table('auth_identities')->insert($data_identity);

        $data_roles = [
            'user_id' => $userID,
            'Funcionario' => 1,
            'Contador' => 0,
            'Presidente' => 0,
            'Secretario' => 0,
            'Admin' => 1,
        ];

        $this->db->table('user_roles')->insert($data_roles);

    }
}
