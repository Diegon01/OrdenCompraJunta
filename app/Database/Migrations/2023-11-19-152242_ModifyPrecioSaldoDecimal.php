<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyPrecioSaldoDecimal extends Migration
{
    public function up()
    {
        $fields_producto = [
            'precio_estimado' => [
                'type' => 'DECIMAL', // Cambiado a DECIMAL para aceptar números con coma
                'constraint' => '65,02', // Ajusta según tus necesidades
            ],
        ];

        $fields_oferta = [
            'precio_oferta' => [
                'type' => 'DECIMAL', // Cambiado a DECIMAL para aceptar números con coma
                'constraint' => '65,02', // Ajusta según tus necesidades
            ],
        ];

        $fields_rubro = [
            'saldo' => [
                'type' => 'DECIMAL', // Cambiado a DECIMAL para aceptar números con coma
                'constraint' => '65,02', // Ajusta según tus necesidades
            ],
        ];

        $fields_rubro_congelado = [
            'saldo_congelado' => [
                'type' => 'DECIMAL', // Cambiado a DECIMAL para aceptar números con coma
                'constraint' => '65,02', // Ajusta según tus necesidades
            ],
        ];
    
        $this->forge->modifyColumn('productoordencompra', $fields_producto);
        $this->forge->modifyColumn('ofertas_producto_proveedor', $fields_oferta);
        $this->forge->modifyColumn('rubros', $fields_rubro);
        $this->forge->modifyColumn('rubros_congelado', $fields_rubro_congelado);
    }

    public function down()
    {
        //
    }
}
