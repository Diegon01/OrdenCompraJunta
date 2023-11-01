<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAutorizadoField extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ordenesdecompra', [
            'Presidente_Autorizado' => ['type' => 'BOOL'],
            // Add more fields here as needed
        ]);
    }

    public function down()
    {
        //
    }
}
