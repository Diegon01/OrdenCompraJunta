<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RubroSaldoCongelado extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'codigo' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'saldo_congelado' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('codigo', true);
        $this->forge->addForeignKey('codigo', 'rubros', 'codigo');
        $this->forge->createTable('rubros_congelado');
    }

    public function down()
    {
        //
    }
}
