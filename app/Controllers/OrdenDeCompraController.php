<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\OrdenDeCompraModel;
use App\Models\OrdenProveedorModel;
use App\Models\ProveedorModel;
use App\Models\ProductoDeOrdenDeCompraModel;

class OrdenDeCompraController extends BaseController
{
    public function index()
    {
        //
    }

    public function alta_orden_compra() {
        // Si se ha enviado un formulario (POST)
        if ($this->request->getMethod() === 'post') {
            // Obtener los datos del formulario
            $data = [
                'posibles_proveedores' => $this->request->getPost('posibles_proveedores'),
                'descripcion' => $this->request->getPost('descripcion'),
                'solicitante_id' => auth()->user()->id,
                'estado' => 'Pendiente',
                'Contador_Aprobado' => 0,
                'Presidente_Aprobado' => 0,
                'Secretario_Aprobado' => 0,
            ];

            // Validar los datos si es necesario
            // Puedes agregar reglas de validación aquí

            // Insertar en la base de datos
            $ordenDeCompraModel = new OrdenDeCompraModel();
            $ordenDeCompraModel->insert($data);
            $ordenCompraID = $ordenDeCompraModel->getInsertID();

            $productos = $this->request->getPost();
            foreach ($productos['nombre'] as $key => $nombre) {
                $datas = [
                    'nombre' => $nombre,
                    'precio_estimado' => $productos['precio_estimado'][$key],
                    'cantidad' => $productos['cant_producto'][$key],
                    'orden_id' => $ordenCompraID, // Asocia el producto con la orden de compra
                ];
    
                // Inserta el producto en la base de datos
                $productoModel = new ProductoDeOrdenDeCompraModel();
                $productoModel->insert($datas);
            }

            // Redirigir a una página de éxito o a la misma página
            // Puedes personalizar esta parte según tus necesidades

            return redirect()->to('/alta-proveedor/exito');
        }

        // Si no se ha enviado el formulario, cargar la vista
        return view('alta_proveedor');
    }

    public function contador_aprueba() {
        // Check if the request method is POST
        if ($this->request->getMethod() === 'post') {
            // Get the order ID from the POST data
            $orderId = $this->request->getPost('order_id');
            
            $productos = json_decode($_POST['lista_productos'], true);

            $orderPresidente = $this->request->getPost('order_Presidente_Aprobado');

            $rubros = $this->request->getPost();

            foreach ($productos as $producto) {
                echo $producto;
            }
            
            foreach ($rubros['rubro'] as $rubro) {
                
            }

            $selectedIDs = $this->request->getPost('selectedIDs'); // Recibir los IDs seleccionados desde el formulario
            foreach ($selectedIDs as $selected) {
                $datas = [
                    'orden_id' => $orderId,
                    'proveedor_id' => $selected,
                ];

                $enlaceModel = new \App\Models\OrdenProveedorModel();
                $enlaceModel->insert($datas);
            }
    
            // Load the OrdenDeCompraModel
            $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
    
            // Find the order by ID
            $order = $ordenCompraModel->find($orderId);
    
            // Check if the order exists
            if ($order) {
                // Update the "Contador_Aprueba" column to 1
                //$ordenCompraModel->update($orderId, ['Contador_Aprobado' => 1]);
    
                // Redirect to the "ordenes" route or any other destination as needed
                //return redirect()->to('/ordenes');
            } else {
                // Handle the case where the order doesn't exist
                //return redirect()->to('/ordenes')->with('error', 'Order not found');
            }
        }
    
        // If the request is not POST, redirect to the "ordenes" route
        //return redirect()->to('/ordenes');
    }

    public function presidente_aprueba() {
        // Check if the request method is POST
        if ($this->request->getMethod() === 'post') {
            // Get the order ID from the POST data
            $orderId = $this->request->getPost('order_id');
            $orderContador = $this->request->getPost('order_Contador_Aprobado');
    
            // Load the OrdenDeCompraModel
            $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
    
            // Find the order by ID
            $order = $ordenCompraModel->find($orderId);
    
            // Check if the order exists
            if ($order) {
                // Update the "Contador_Aprueba" column to 1
                $ordenCompraModel->update($orderId, ['Presidente_Aprobado' => 1]);
    
                // Redirect to the "ordenes" route or any other destination as needed
                return redirect()->to('/ordenes');
            } else {
                // Handle the case where the order doesn't exist
                return redirect()->to('/ordenes')->with('error', 'Order not found');
            }
        }
    
        // If the request is not POST, redirect to the "ordenes" route
        return redirect()->to('/ordenes');
    }

    public function secretario_aprueba() {
        // Check if the request method is POST
        if ($this->request->getMethod() === 'post') {
            // Get the order ID from the POST data
            $orderId = $this->request->getPost('order_id');
            $orderContador = $this->request->getPost('order_Secretario_Aprobado');
    
            // Load the OrdenDeCompraModel
            $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
    
            // Find the order by ID
            $order = $ordenCompraModel->find($orderId);
    
            // Check if the order exists
            if ($order) {
                // Update the "Contador_Aprueba" column to 1
                $ordenCompraModel->update($orderId, ['Secretario_Aprobado' => 1]);
                $ordenCompraModel->update($orderId, ['estado' => 'Aceptada']);
    
                // Redirect to the "ordenes" route or any other destination as needed
                return redirect()->to('/ordenes');
            } else {
                // Handle the case where the order doesn't exist
                return redirect()->to('/ordenes')->with('error', 'Order not found');
            }
        }
    
        // If the request is not POST, redirect to the "ordenes" route
        return redirect()->to('/ordenes');
    }

    public function solicitud_rechaza() {
        // Check if the request method is POST
        if ($this->request->getMethod() === 'post') {
            // Get the order ID from the POST data
            $orderId = $this->request->getPost('order_id');
            $orderContador = $this->request->getPost('order_Contador_Aprobado');
    
            // Load the OrdenDeCompraModel
            $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
    
            // Find the order by ID
            $order = $ordenCompraModel->find($orderId);
    
            // Check if the order exists
            if ($order) {
                // Update the "Contador_Aprueba" column to 1
                $ordenCompraModel->update($orderId, ['estado' => 'Rechazada']);
    
                // Redirect to the "ordenes" route or any other destination as needed
                return redirect()->to('/ordenes');
            } else {
                // Handle the case where the order doesn't exist
                return redirect()->to('/ordenes')->with('error', 'Order not found');
            }
        }
    
        // If the request is not POST, redirect to the "ordenes" route
        return redirect()->to('/ordenes');
    }
}
