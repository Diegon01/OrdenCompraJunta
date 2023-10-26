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

        $data_user_contador = [
            'username' => 'contador.publico',
            'nombres' => 'Contador',
            'apellidos' => 'Publico',
            'cedula' => '1234567891',
            // Add more user data as needed
        ];

        $data_user_presidente = [
            'username' => 'presidente.publico',
            'nombres' => 'Presidente',
            'apellidos' => 'Publico',
            'cedula' => '1234567892',
            // Add more user data as needed
        ];

        $data_user_secretario = [
            'username' => 'secretario.publico',
            'nombres' => 'Secretario',
            'apellidos' => 'Publico',
            'cedula' => '1234567893',
            // Add more user data as needed
        ];

        $data_user_funcionario = [
            'username' => 'funcionario.publico',
            'nombres' => 'Funcionario',
            'apellidos' => 'Publico',
            'cedula' => '1234567894',
            // Add more user data as needed
        ];

        $this->db->table('users')->insert($data_user); // ACA EMPIEZA!!!!!!!!!!!!!!!!!!!!

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


        $this->db->table('users')->insert($data_user_contador);

        $userID = $this->db->insertID();

        // Original password (unhashed)
        $originalPassword = 'contador'; // Replace this with the actual password

        // Hash the password using password_hash
        $hashedPassword_contador = password_hash($originalPassword, PASSWORD_BCRYPT);

        $data_identity_contador = [
            'user_id' => $userID,
            'type' => 'email_password',
            'secret' => 'contador@publico.com',
            'secret2' => $hashedPassword_contador, // Insert the hashed password
            'force_reset' => 1,
        ];

        $this->db->table('auth_identities')->insert($data_identity_contador);

        $data_roles_contador = [
            'user_id' => $userID,
            'Funcionario' => 1,
            'Contador' => 1,
            'Presidente' => 0,
            'Secretario' => 0,
            'Admin' => 0,
        ];

        $this->db->table('user_roles')->insert($data_roles_contador);

        $this->db->table('users')->insert($data_user_funcionario); // ACA EMPIEZA!!!!!!!!!!!!!!!!!!!!

        $userID = $this->db->insertID();

        // Original password (unhashed)
        $originalPassword = 'funcionario'; // Replace this with the actual password

        // Hash the password using password_hash
        $hashedPassword_presidente = password_hash($originalPassword, PASSWORD_BCRYPT);

        $data_identity_funcionario = [
            'user_id' => $userID,
            'type' => 'email_password',
            'secret' => 'funcionario@publico.com',
            'secret2' => $hashedPassword_presidente, // Insert the hashed password
            'force_reset' => 1,
        ];

        $this->db->table('auth_identities')->insert($data_identity_funcionario);

        $data_roles_funcionario = [
            'user_id' => $userID,
            'Funcionario' => 1,
            'Contador' => 0,
            'Presidente' => 0,
            'Secretario' => 0,
            'Admin' => 0,
        ];

        $this->db->table('user_roles')->insert($data_roles_funcionario);

        $this->db->table('users')->insert($data_user_presidente); // ACA EMPIEZA!!!!!!!!!!!!!!!!!!!!

        $userID = $this->db->insertID();

        // Original password (unhashed)
        $originalPassword = 'presidente'; // Replace this with the actual password

        // Hash the password using password_hash
        $hashedPassword_funcionario = password_hash($originalPassword, PASSWORD_BCRYPT);

        $data_identity_presidente = [
            'user_id' => $userID,
            'type' => 'email_password',
            'secret' => 'presidente@publico.com',
            'secret2' => $hashedPassword_funcionario, // Insert the hashed password
            'force_reset' => 1,
        ];

        $this->db->table('auth_identities')->insert($data_identity_presidente);

        $data_roles_presidente = [
            'user_id' => $userID,
            'Funcionario' => 1,
            'Contador' => 0,
            'Presidente' => 1,
            'Secretario' => 0,
            'Admin' => 0,
        ];

        $this->db->table('user_roles')->insert($data_roles_presidente);

        $this->db->table('users')->insert($data_user_secretario); // ACA EMPIEZA!!!!!!!!!!!!!!!!!!!!

        $userID = $this->db->insertID();

        // Original password (unhashed)
        $originalPassword = 'secretario'; // Replace this with the actual password

        // Hash the password using password_hash
        $hashedPassword_secretario = password_hash($originalPassword, PASSWORD_BCRYPT);

        $data_identity_secretario = [
            'user_id' => $userID,
            'type' => 'email_password',
            'secret' => 'secretario@publico.com',
            'secret2' => $hashedPassword_secretario, // Insert the hashed password
            'force_reset' => 1,
        ];

        $this->db->table('auth_identities')->insert($data_identity_secretario);

        $data_roles_secretario = [
            'user_id' => $userID,
            'Funcionario' => 1,
            'Contador' => 0,
            'Presidente' => 0,
            'Secretario' => 1,
            'Admin' => 0,
        ];

        $this->db->table('user_roles')->insert($data_roles_secretario);

    }
}
