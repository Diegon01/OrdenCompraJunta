<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RubroModel;

class RubroController extends BaseController
{
    public function insertRubro()
    {
        // Get data to be inserted (you can get this from a form)
        $data = [
            'nombre' => 'Rubro de prueba',
            'codigo' => '1234',
            'saldo' => '2000',
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
