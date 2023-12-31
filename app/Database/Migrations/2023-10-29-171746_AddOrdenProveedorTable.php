<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrdenProveedorTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'proveedor_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'orden_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey(['proveedor_id', 'orden_id'], true);
        $this->forge->addForeignKey('proveedor_id', 'proveedores', 'id');
        $this->forge->addForeignKey('orden_id', 'ordenesdecompra', 'id');
        $this->forge->createTable('Enlace_OrdenesProveedores', true);
    }

    public function down()
    {
        $this->forge->dropTable('Enlace_OrdenesProveedores');
    }
}
