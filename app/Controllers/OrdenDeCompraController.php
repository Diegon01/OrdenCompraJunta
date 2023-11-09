<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\OrdenDeCompraModel;
use App\Models\OrdenProveedorModel;
use App\Models\ProveedorModel;
use App\Models\ProductoDeOrdenDeCompraModel;
use App\Models\OfertaModel;
use App\Models\OrdenFinalModel;


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
                'Presidente_Autorizado' => 0,
                'Ofertas_Ingresadas' => 0,
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

            $esLicitacion = $this->request->getPost('esLicitacionSi');

            echo $esLicitacion;
            
            $productos = json_decode($this->request->getPost('lista_productos'), true);

            $orderPresidente = $this->request->getPost('order_Presidente_Aprobado');

            $productos = $this->request->getPost();

            //echo 'Productos: <br>';
            foreach ($productos['id_producto'] as $key => $id) {
  
                $productoModel = new \App\Models\ProductoDeOrdenDeCompraModel();
                $producto = $productoModel->find($id);
                $producto['rubro_id'] = $productos['nro_rubro'][$key];
                
                if ($productoModel->save($producto)) {

                } else {

                }
            }

            $selectedIDs = $this->request->getPost('selectedIDs'); // Recibir los IDs seleccionados desde el formulario

            foreach ($selectedIDs as $selected) {
                

                $selectedIDsArray = explode(',', $selected);

                foreach ($selectedIDsArray as $finally) {
                    $finallyAsInt = intval($finally);
                    $orderAsInt = intval($orderId);

                    $datas = [
                        'proveedor_id' => $finallyAsInt,
                        'orden_id' => $orderAsInt,
                    ];

                    $enlaceModel = new \App\Models\OrdenProveedorModel();
                    $enlaceModel->insert($datas);
                }

                

                
            }
    
            // Load the OrdenDeCompraModel
            $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
    
            // Find the order by ID
            $order = $ordenCompraModel->find($orderId);
    
            // Check if the order exists
            if ($order) {
                // Update the "Contador_Aprueba" column to 1
                $ordenCompraModel->update($orderId, ['Contador_Aprobado' => 1]);

                if ($esLicitacion === '1') {
                    $ordenCompraModel->update($orderId, ['licitacion' => 1]);
                }

                if ($esLicitacion === '0' || $esLicitacion == null) {
                    $ordenCompraModel->update($orderId, ['licitacion' => 0]);
                }

                $solicitante_id = $order['solicitante_id'];
                $userModel_orden = new \App\Models\UserModelo();
                $solicitante = $userModel_orden
                    ->join('auth_identities', 'auth_identities.user_id = users.id')
                    ->find($solicitante_id);

                $notificacionController = new \App\Controllers\NotificacionController();
                $destino = $solicitante->secret;
                $oid = $order['id'];
                $notificacionController->intervencionFinalizada($destino, $oid); // auth()->user()->id
    
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

    public function presidente_aprueba() {
        // Check if the request method is POST
        if ($this->request->getMethod() === 'post') {
            // Get the order ID from the POST data
            $orderId = $this->request->getPost('order_id');
            $orderContador = $this->request->getPost('order_Contador_Aprobado');
            $esLicitacion = $this->request->getPost('esLicitacion');

    
            // Load the OrdenDeCompraModel
            $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
    
            // Find the order by ID
            $order = $ordenCompraModel->find($orderId);
    
            // Check if the order exists
            if ($order) {
                // Update the "Contador_Aprueba" column to 1
                $ordenCompraModel->update($orderId, ['Presidente_Aprobado' => 1]);

                if ($esLicitacion === '1') {
                    // PENDIENTE IMPLEMENTACION
                }

                if ($esLicitacion === '0') {
                    // PENDIENTE IMPLEMENTACION
                }
    
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
    
            // Load the OrdenDeCompraModel
            $ordenCompraModel = new \App\Models\OrdenFinalModel();
    
            // Find the order by ID
            $order = $ordenCompraModel->find($orderId);
    
            // Check if the order exists
            if ($order) {
                // Update the "Contador_Aprueba" column to 1
                $ordenCompraModel->update($orderId, ['secretario_visto' => 1]);
                //$ordenCompraModel->update($orderId, ['estado' => 'Aceptada']);
    
                // Redirect to the "ordenes" route or any other destination as needed
                return redirect()->to('/ordenescompra');
            } else {
                // Handle the case where the order doesn't exist
                return redirect()->to('/ordenescompra')->with('error', 'Order not found');
            }
        }
    
        // If the request is not POST, redirect to the "ordenes" route
        return redirect()->to('/ordenes');
    }

    public function presidente_autoriza() {
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
                $ordenCompraModel->update($orderId, ['Presidente_Autorizado' => 1]);
                //$ordenCompraModel->update($orderId, ['estado' => 'Aceptada']);
    
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

    public function ingreso_oferta() {
        // Check if the request method is POST
        if ($this->request->getMethod() === 'post') {
            $orderId = $this->request->getPost('order_id');
            $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
            $order = $ordenCompraModel->find($orderId);
            
            $proveedores = $this->request->getPost('id_proveedor');

            $ofertas = $this->request->getPost('id_producto');

            $precio_ofertado = $this->request->getPost('precio_producto');

            $notas = $this->request->getPost('notas_producto');

            foreach ($ofertas as $key => $idProducto) {
                $productoModel = new \App\Models\ProductoDeOrdenDeCompraModel();
                $producto = $productoModel->find($idProducto);

                $proveedorModel = new \App\Models\ProveedorModel();
                $proveedor = $proveedorModel->find($proveedores[$key]);

                $datas = [
                    'producto_id' => $producto['id'],
                    'proveedor_id' => $proveedor['id'],
                    'precio_oferta' => $precio_ofertado[$key],
                    'notas' => $notas[$key],
                ];

                $ofertaModel = new \App\Models\OfertaModel();
                $ofertaModel->insert($datas);
           }
           $ordenCompraModel->update($orderId, ['Ofertas_Ingresadas' => '1']);
            return redirect()->to('/ordenes');

        }

        return redirect()->to('/ordenes');

    }

    public function eleccion_oferta() {
        // Check if the request method is POST
        if ($this->request->getMethod() === 'post') {
            //return redirect()->to('/ordenes');
            $orderId = $this->request->getPost('order_id');
            $provId = $this->request->getPost('prov_id');

            $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
            $order = $ordenCompraModel->find($orderId);

            $proveedorModel = new \App\Models\ProveedorModel();
            $proveedor = $proveedorModel->find($provId);

            $productoOrdenCompraModel = new \App\Models\ProductoDeOrdenDeCompraModel();
            $productos = $productoOrdenCompraModel->where('orden_id', $orderId)->findAll();

            $ofertaModel = new \App\Models\OfertaModel();
            $ofertas = []; // Initialize the $ofertas array
            foreach ($productos as $pro) {
                $newOfertas = $ofertaModel->where('producto_id', $pro['id'])
                ->where('proveedor_id', $proveedor['id'])
                ->findAll();                
                $ofertas = array_merge($ofertas, $newOfertas);
            }

            $rubrosModel = new \App\Models\RubroModel();
            $rubrosCongeladoModel = new \App\Models\RubroSaldoCongeladoModel();
            $rubro = null;
            $rubro_congelado = null;
            foreach ($ofertas as $ofer) { // CONGELA EL SALDO UTILIZADO DEL RUBRO
                foreach ($productos as $product) {
                    if ($product['id'] === $ofer['producto_id']) {
                        $rubro = $rubrosModel->find($product['rubro_id']);
                        $rubro_congelado = $rubrosCongeladoModel->find($product['rubro_id']);
                        $arestar = $ofer['precio_oferta'] * $product['cantidad'];
                        $nuevosaldo = $rubro['saldo'] - $arestar;
                        $nuevocongelado = $rubro_congelado['saldo_congelado'] + $arestar;
                        $rubrosCongeladoModel->update($product['rubro_id'], ['saldo_congelado' => $nuevocongelado]);
                        $rubrosModel->update($product['rubro_id'], ['saldo' => $nuevosaldo]);
                    }
                }
            }

            $data_ordenfinal = [
                'proveedor_id' => $proveedor['id'],
                'solicitante_id' => $order['solicitante_id'],
                'solicitud_id' => $order['id'],
                'secretario_visto' => 0,
            ];

            $ordenfinalModel = new \App\Models\OrdenFinalModel();
            $ordenfinalModel->insert($data_ordenfinal);
            $ordenFinalID = $ordenfinalModel->insertID();

            $ordenfinalproductoModel = new \App\Models\OrdenFinalProductosModel();
            $data_ordenfinal_producto = [];
            foreach ($ofertas as $ofer) {
                foreach ($productos as $product) {
                    if ($product['id'] === $ofer['producto_id']) {
                        $data_ordenfinal_producto = [
                            'ordenfinal_id' => $ordenFinalID,
                            'proveedor_id' => $ofer['proveedor_id'],
                            'rubro_id' => $product['rubro_id'],
                            'costo' => $ofer['precio_oferta'],
                            'cantidad' => $product['cantidad'],
                            'notas' => $ofer['notas'],
                            'nombre' => $product['nombre'],
                        ];
                        $ordenfinalproductoModel->insert($data_ordenfinal_producto);
                    }
                }
            }

            $ordenCompraModel->update($orderId, ['estado' => 'Aceptada']);
            

        }

        return redirect()->to('/ordenes');

    }

}
