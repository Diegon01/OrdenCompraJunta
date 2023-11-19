<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddObsField extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ordenesdecompra', [
            'observaciones' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            // Add more fields here as needed
        ]);
    }

    public function down()
    {
        //
    }
}
