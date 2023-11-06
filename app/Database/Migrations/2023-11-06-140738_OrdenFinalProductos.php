<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrdenFinalProductos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true, // Add this line to auto-increment the ID
            ],
            'ordenfinal_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'proveedor_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'rubro_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'costo' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'cantidad' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'notas' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('proveedor_id', 'proveedores', 'id');
        $this->forge->addForeignKey('ordenfinal_id', 'ordenfinal', 'id');
        $this->forge->addForeignKey('rubro_id', 'rubros', 'codigo');
        $this->forge->createTable('ordenfinal_productos', true);
    }

    public function down()
    {
        //
    }
}
