<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserRoles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'Funcionario' => [
                'type' => 'BOOL',
            ],
            'Contador' => [
                'type' => 'BOOL',
            ],
            'Presidente' => [
                'type' => 'BOOL',
            ],
            'Secretario' => [
                'type' => 'BOOL',
            ],
            'Admin' => [
                'type' => 'BOOL',
            ],
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('user_roles');
    }

    public function down()
    {
        $this->forge->dropTable('user_roles');
    }
}
