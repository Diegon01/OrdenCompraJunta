<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrdenFieldsMasMas extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ordenesdecompra', [
            'Ofertas_Ingresadas' => ['type' => 'BOOL'],
            // Add more fields here as needed
        ]);
    }

    public function down()
    {
        //
    }
}
