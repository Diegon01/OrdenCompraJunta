<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrdenBooleanSecretario extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ordenesdecompra', [
            'Secretario_Aprobado' => ['type' => 'BOOL'],
            // Add more fields here as needed
        ]);
    }

    public function down()
    {
        //
    }
}
