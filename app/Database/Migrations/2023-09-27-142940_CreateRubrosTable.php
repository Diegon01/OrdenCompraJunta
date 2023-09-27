<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRubrosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'codigo' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'saldo' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('codigo', true);
        $this->forge->createTable('rubros');
    }

    public function down()
    {
        $this->forge->dropTable('rubros');
    }
}