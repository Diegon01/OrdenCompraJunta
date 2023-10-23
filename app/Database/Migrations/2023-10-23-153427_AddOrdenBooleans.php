<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrdenBooleans extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ordenesdecompra', [
            'Contador_Aprobado' => ['type' => 'BOOL'],
            'Presidente_Aprobado' => ['type' => 'BOOL'],
            // Add more fields here as needed
        ]);
    }

    public function down()
    {
        //
    }
}
