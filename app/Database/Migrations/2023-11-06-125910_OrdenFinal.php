<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrdenFinal extends Migration
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
            'proveedor_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'solicitante_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'solicitud_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'secretario_visto' => [
                'type' => 'BOOLEAN',
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
            ],
            'deleted_at' => [
                'type' => 'datetime',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('proveedor_id', 'proveedores', 'id');
        $this->forge->addForeignKey('solicitante_id', 'users', 'id');
        $this->forge->addForeignKey('solicitud_id', 'ordenesdecompra', 'id');
        $this->forge->createTable('ordenfinal');
    }

    public function down()
    {
        //
    }
}
