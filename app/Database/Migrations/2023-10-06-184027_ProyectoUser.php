<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProyectoUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'apellido' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'cedula' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('cedula', true);
        $this->forge->createTable('proyecto_users');
    }

    public function down()
    {
        $this->forge->dropTable('proyecto_users');
    }
}
