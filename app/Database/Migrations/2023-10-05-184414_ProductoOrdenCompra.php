<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductoOrdenCompra extends Migration
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
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'precio_estimado' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'cantidad' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ProductoOrdenCompra');
    }

    public function down()
    {
        $this->forge->dropTable('ProductoOrdenCompra');
    }
}
