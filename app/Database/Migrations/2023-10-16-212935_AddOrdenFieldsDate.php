<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrdenFieldsDate extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ordenesdecompra', [
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            // Add more fields here as needed
        ]);
        $this->forge->addForeignKey('solicitante_id', 'users', 'id');
    }

    public function down()
    {
        $this->forge->dropColumn('ordenesdecompra', 'solicitante_id');
        $this->forge->dropColumn('ordenesdecompra', 'estado');
        // Drop other fields if necessary
    }
}
