<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrdenDeCompra extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'posibles_proveedores' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('OrdenesDeCompra');
    }

    public function down()
    {
        $this->forge->dropTable('OrdenesDeCompra');
    }
}
