<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserFields extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'nombres' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'apellidos' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'cedula' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            // Add more fields here as needed
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'first_name');
        $this->forge->dropColumn('users', 'last_name');
        // Drop other fields if necessary
    }
}
