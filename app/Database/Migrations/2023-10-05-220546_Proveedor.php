<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Proveedor extends Migration
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
            'persona_de_contacto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'numero_de_contacto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'RUT' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'numero_de_cuenta' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'fecha_de_vencimiento_dgi' => [
                'type' => 'DATE',
            ],
            'fecha_de_vencimiento_bps' => [
                'type' => 'DATE',
            ],
            'rupe' => [
                'type' => 'BOOLEAN',
            ],
            'empresa_del_estado' => [
                'type' => 'BOOLEAN',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('proveedores');
    }

    public function down()
    {
        $this->forge->dropTable('proveedores');
    }
}
