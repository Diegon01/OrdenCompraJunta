<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOfertas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'producto_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'proveedor_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'precio_oferta' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'notas' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey(['producto_id', 'proveedor_id'], true);
        $this->forge->addForeignKey('producto_id', 'productoordencompra', 'id');
        $this->forge->addForeignKey('proveedor_id', 'proveedores', 'id');
        $this->forge->createTable('Ofertas_Producto_Proveedor', true);
    }

    public function down()
    {
        //
    }
}
