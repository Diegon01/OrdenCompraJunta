<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductoField extends Migration
{
    public function up()
    {
        $this->forge->addColumn('productoordencompra', [
            'orden_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            // Add more fields here as needed
        ]);
        $this->forge->addForeignKey('orden_id', 'ordenesdecompra', 'id');
    }

    public function down()
    {
        $this->forge->dropColumn('productoordencompra', 'orden_id');
        // Drop other fields if necessary
    }
}
