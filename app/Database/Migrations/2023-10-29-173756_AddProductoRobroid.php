<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductoRobroid extends Migration
{
    public function up()
    {
        $this->forge->addColumn('productoordencompra', [
            'rubro_id' => ['type' => 'INT', 'constraint' => 5, 'null' => true],
            // Add more fields here as needed
        ]);
        $this->forge->addForeignKey('rubro_id', 'rubros', 'codigo');
    }

    public function down()
    {
        //
    }
}
