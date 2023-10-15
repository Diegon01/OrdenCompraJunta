<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrdenFields extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ordenesdecompra', [
            'solicitante_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'estado' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
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
