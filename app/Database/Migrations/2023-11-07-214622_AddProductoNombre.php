<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductoNombre extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ordenfinal_productos', [
            'nombre' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            // Add more fields here as needed
        ]);
    }

    public function down()
    {
        //
    }
}
