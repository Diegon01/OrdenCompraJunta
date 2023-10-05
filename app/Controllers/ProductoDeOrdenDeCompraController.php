<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProductoDeOrdenDeCompraController extends BaseController
{
    public function insertProductoOrdenCompra()
    {
        // Get data to be inserted (you can get this from a form)
        $data = [
            'rubro_codigo' => '1234',
            'nombre' => 'Producto Orden Compra de prueba',
            'precio_estimado' => '110',
            // Add other fields as needed
        ];

        // Create an instance of the RubroModel
        $rubroModel = new RubroModel();

        // Insert the data into the 'rubro' table
        
        $rubroModel->insert($data);

        // Optionally, you can redirect to a different page after insertion
        return redirect()->to('rubro/created'); // Replace 'rubro/list' with your desired URL
    }
}
