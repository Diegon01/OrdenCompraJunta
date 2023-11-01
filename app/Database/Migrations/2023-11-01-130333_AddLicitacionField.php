<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLicitacionField extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ordenesdecompra', [
            'licitacion' => ['type' => 'BOOL'],
            // Add more fields here as needed
        ]);
    }

    public function down()
    {
        //
    }
}
