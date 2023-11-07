<?php

namespace App\Controllers;
use App\Models\OrdenDeCompraModel;
use App\Models\ProveedorModel;
use App\Models\ProductoDeOrdenDeCompraModel;
use CodeIgniter\Pager\Pager;
use App\Models\UserModelo;
use App\Models\RubroModel;
use App\Models\OrdenProveedorModel;
use App\Models\OfertaModel;

class Home extends BaseController
{
    public function index(): string
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
        ];
        return $this->mis_ordenes();
    }
    public function proveedor_created(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
        ];
        return view('proveedor_exito', $data);
    }
    public function proveedor_crear(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
        ];
        return view('alta_proveedor', $data);
    }
    public function solicitud_orden_compra_crear(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
        ];
        return view('alta_solicitudOrdenCompra', $data);
    }
    public function usuario_crear(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
        ];
        return view('alta_usuario', $data);
    }
    public function registrar_created(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
        ];
        return view('registro_exito', $data);
    }
    public function ver_ordenes(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
         // Cargar el modelo
         $ordenCompraModel = new \App\Models\OrdenDeCompraModel();

         // Configurar la paginación
         $pager = \Config\Services::pager();
         $page = $this->request->getVar('page') ?? 1; // Obtener el número de página de la URL
         $perPage = 8; // Número de resultados por página
         $totalResults = $ordenCompraModel->countAll(); // Obtener el total de resultados

         // Get the "sort" query parameter from the URL
        $sort = $this->request->getGet('sort');
        $estado = $this->request->getGet('estado');
        $searchQuery = $this->request->getGet('search');

        if ($searchQuery == null) {
            $searchQuery = '';
        }

        // Set the default sort order
        $sortOrder = 'desc'; // Default to newest

        if ($sort === 'oldest') {
            $sortOrder = 'asc';
        }

        $estadoFiltro = 'all';

        if ($estado === 'pendiente') {
            $estadoFiltro = 'Pendiente';
        }

        if ($estado === 'aceptada') {
            $estadoFiltro = 'Aceptada';
        }

        if ($estado === 'rechazada') {
            $estadoFiltro = 'Rechazada';
        }

        $productoOrdenCompraModel = new \App\Models\ProductoDeOrdenDeCompraModel();

         // Replace 'product_column1, product_column2, ...' with the actual columns you want to retrieve
         $productos = $productoOrdenCompraModel->select('*')
             ->findAll();
 
         // Obtener las órdenes de compra para la página actual
         if ($estadoFiltro === 'all') {
            $ordenes = $ordenCompraModel->select('ordenesdecompra.*, users.nombres, users.apellidos')
                ->join('users', 'users.id = ordenesdecompra.solicitante_id')
                ->groupStart()
                    ->like("DATE(ordenesdecompra.created_at)", $searchQuery) // Replace 'column_name' with the actual column you want to search in
                    ->orLike("CONCAT(users.nombres, ' ', users.apellidos)", $searchQuery) // Search in the combined 'nombres' and 'apellidos' columns
                    ->orGroupStart()
                        ->select('nombre')
                        ->from('productoordencompra')
                        ->where('productoordencompra.orden_id = ordenesdecompra.id')
                        ->like('nombre', $searchQuery) // Search for 'product_name' in 'productos' table
                    ->groupEnd()
                ->groupEnd()
                ->groupBy('ordenesdecompra.id') // Group by the unique identifier (e.g., 'id' of 'ordenesdecompra')
                ->orderBy('ordenesdecompra.created_at', $sortOrder) // Adjust the order here
                ->paginate($perPage, 'default', $page);
         }
         else {
            $ordenes = $ordenCompraModel->select('ordenesdecompra.*, users.nombres, users.apellidos')
                ->join('users', 'users.id = ordenesdecompra.solicitante_id')
                ->groupStart()
                    ->like("DATE(ordenesdecompra.created_at)", $searchQuery) // Replace 'column_name' with the actual column you want to search in
                    ->orLike("CONCAT(users.nombres, ' ', users.apellidos)", $searchQuery) // Search in the combined 'nombres' and 'apellidos' columns
                    ->orGroupStart()
                        ->select('nombre')
                        ->from('productoordencompra')
                        ->where('productoordencompra.orden_id = ordenesdecompra.id')
                        ->like('nombre', $searchQuery) // Search for 'product_name' in 'productos' table
                    ->groupEnd()
                ->groupEnd()
                ->where('estado', $estadoFiltro)
                ->groupBy('ordenesdecompra.id') // Group by the unique identifier (e.g., 'id' of 'ordenesdecompra')
                ->orderBy('ordenesdecompra.created_at', $sortOrder) // Adjust the order here
                ->paginate($perPage, 'default', $page);
         }
        
         $data = [
             'ordenes' => $ordenes,
             'productos' => $productos,
             'pager' => $ordenCompraModel->pager,
             'isAdmin' => $isAdmin,
             'isFuncionario' => $isFuncionario,
             'isContador' => $isContador,
             'isPresidente' => $isPresidente,
             'isSecretario' => $isSecretario,
             'currentUserId' => $currentUserId,
         ];
 
         return view('ABM_SolicitudesCompra', $data);
    }
    public function mis_ordenes(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();

        $currentUserId = auth()->user()->id;

         // Cargar el modelo
         $ordenCompraModel = new \App\Models\OrdenDeCompraModel();

         // Configurar la paginación
         $pager = \Config\Services::pager();
         $page = $this->request->getVar('page') ?? 1; // Obtener el número de página de la URL
         $perPage = 8; // Número de resultados por página
         $totalResults = $ordenCompraModel->countAll(); // Obtener el total de resultados

         // Get the "sort" query parameter from the URL
         $sort = $this->request->getGet('sort');
         $estado = $this->request->getGet('estado');
         $searchQuery = $this->request->getGet('search');

        if ($searchQuery == null) {
            $searchQuery = '';
        }
 
         // Set the default sort order
         $sortOrder = 'desc'; // Default to newest
 
         if ($sort === 'oldest') {
             $sortOrder = 'asc';
         }
 
         $estadoFiltro = 'all';
 
         if ($estado === 'pendiente') {
             $estadoFiltro = 'Pendiente';
         }
 
         if ($estado === 'aceptada') {
             $estadoFiltro = 'Aceptada';
         }
 
         if ($estado === 'rechazada') {
             $estadoFiltro = 'Rechazada';
         }

         $productoOrdenCompraModel = new \App\Models\ProductoDeOrdenDeCompraModel();

         // Replace 'product_column1, product_column2, ...' with the actual columns you want to retrieve
         $productos = $productoOrdenCompraModel->select('*')
             ->findAll();

         // Obtener las órdenes de compra para la página actual
         if ($estadoFiltro === 'all') {
            $ordenes = $ordenCompraModel->select('ordenesdecompra.*, users.nombres, users.apellidos')
                ->join('users', 'users.id = ordenesdecompra.solicitante_id')
                ->groupStart()
                    ->like("DATE(ordenesdecompra.created_at)", $searchQuery) // Replace 'column_name' with the actual column you want to search in
                    ->orLike("CONCAT(users.nombres, ' ', users.apellidos)", $searchQuery) // Search in the combined 'nombres' and 'apellidos' columns
                    ->orGroupStart()
                        ->select('nombre')
                        ->from('productoordencompra')
                        ->where('productoordencompra.orden_id = ordenesdecompra.id')
                        ->like('nombre', $searchQuery) // Search for 'product_name' in 'productos' table
                    ->groupEnd()
                ->groupEnd()
                ->where('solicitante_id', $currentUserId)
                ->groupBy('ordenesdecompra.id') // Group by the unique identifier (e.g., 'id' of 'ordenesdecompra')
                ->orderBy('ordenesdecompra.created_at', $sortOrder) // Adjust the order here
                ->paginate($perPage, 'default', $page);
         }
         else {
            $ordenes = $ordenCompraModel->select('ordenesdecompra.*, users.nombres, users.apellidos')
                ->join('users', 'users.id = ordenesdecompra.solicitante_id')
                ->groupStart()
                    ->like("DATE(ordenesdecompra.created_at)", $searchQuery) // Replace 'column_name' with the actual column you want to search in
                    ->orLike("CONCAT(users.nombres, ' ', users.apellidos)", $searchQuery) // Search in the combined 'nombres' and 'apellidos' columns
                    ->orGroupStart()
                        ->select('nombre')
                        ->from('productoordencompra')
                        ->where('productoordencompra.orden_id = ordenesdecompra.id')
                        ->like('nombre', $searchQuery) // Search for 'product_name' in 'productos' table
                    ->groupEnd()
                ->groupEnd()
                ->where([
                    'solicitante_id' => $currentUserId,
                    'estado' => $estadoFiltro,
                ])
                ->groupBy('ordenesdecompra.id') // Group by the unique identifier (e.g., 'id' of 'ordenesdecompra')
                ->orderBy('ordenesdecompra.created_at', $sortOrder) // Adjust the order here
                ->paginate($perPage, 'default', $page);
         }
        
         $data = [
             'ordenes' => $ordenes,
             'productos' => $productos,
             'pager' => $ordenCompraModel->pager,
             'isAdmin' => $isAdmin,
             'isFuncionario' => $isFuncionario,
             'isContador' => $isContador,
             'isPresidente' => $isPresidente,
             'isSecretario' => $isSecretario,
             'currentUserId' => $currentUserId,
         ];
 
         return view('ABM_SolicitudesPropias', $data);
    }
    public function rubro_crear(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
        ];
        return view('alta_rubro', $data);
    } 
    public function verDetalle_Solicitud(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
        ];
        return view('ver_DetalleSolicitudOrden', $data);
    }       


    
    public function ver_solicitud_detalles($orden_id): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();

        $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
        $orden = $ordenCompraModel->find($orden_id);

        $productoOrdenCompraModel = new \App\Models\ProductoDeOrdenDeCompraModel();
        $productos = $productoOrdenCompraModel->where('orden_id', $orden_id)->findAll();

        $enlaceModel = new \App\Models\OrdenProveedorModel();
        $enlaces = $enlaceModel->where('orden_id', $orden_id)->findAll();

        $rubrosModel = new \App\Models\RubroModel();
        $rubros = $rubrosModel->findAll();

        $proveedoresModel = new \App\Models\ProveedorModel();
        $proveedores = $proveedoresModel->findAll();

        $solicitante_id = $orden['solicitante_id'];
        $userModel_orden = new \App\Models\UserModelo();
        $solicitante = $userModel_orden->find($solicitante_id);

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'orden' => $orden,
            'productos' => $productos,
            'solicitante' => $solicitante,
            'rubros' => $rubros,
            'proveedores' => $proveedores,
            'enlaces' => $enlaces,
        ];
        return view('solicitud_detalles', $data);
    }
    
    public function ingresar_ofertas($orden_id): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();

        $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
        $orden = $ordenCompraModel->find($orden_id);

        $rubrosModel = new \App\Models\RubroModel();
        $rubros = $rubrosModel->findAll();

        $productoOrdenCompraModel = new \App\Models\ProductoDeOrdenDeCompraModel();
        $productos = $productoOrdenCompraModel->where('orden_id', $orden_id)->findAll();

        $enlaceModel = new \App\Models\OrdenProveedorModel();
        $enlaces = $enlaceModel->where('orden_id', $orden_id)->findAll();

        $proveedoresModel = new \App\Models\ProveedorModel();
        $proveedores = $proveedoresModel->findAll();

        $solicitante_id = $orden['solicitante_id'];
        $userModel_orden = new \App\Models\UserModelo();
        $solicitante = $userModel_orden->find($solicitante_id);

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'orden' => $orden,
            'productos' => $productos,
            'solicitante' => $solicitante,
            'proveedores' => $proveedores,
            'enlaces' => $enlaces,
            'rubros' => $rubros,
        ];
        return view('ingresar_ofertas', $data);
    } 

    public function elegir_ofertas($orden_id): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();

        $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
        $orden = $ordenCompraModel->find($orden_id);

        $rubrosModel = new \App\Models\RubroModel();
        $rubros = $rubrosModel->findAll();

        $productoOrdenCompraModel = new \App\Models\ProductoDeOrdenDeCompraModel();
        $productos = $productoOrdenCompraModel->where('orden_id', $orden_id)->findAll();

        $ofertaModel = new \App\Models\OfertaModel();
        $ofertas = []; // Initialize the $ofertas array
        foreach ($productos as $pro) {
            $newOfertas = $ofertaModel->where('producto_id', $pro['id'])->findAll();
            $ofertas = array_merge($ofertas, $newOfertas);
        }

        $enlaceModel = new \App\Models\OrdenProveedorModel();
        $enlaces = $enlaceModel->where('orden_id', $orden_id)->findAll();

        $proveedoresModel = new \App\Models\ProveedorModel();
        $proveedores = $proveedoresModel->findAll();

        $solicitante_id = $orden['solicitante_id'];
        $userModel_orden = new \App\Models\UserModelo();
        $solicitante = $userModel_orden->find($solicitante_id);

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'orden' => $orden,
            'productos' => $productos,
            'solicitante' => $solicitante,
            'proveedores' => $proveedores,
            'enlaces' => $enlaces,
            'rubros' => $rubros,
            'ofertas' => $ofertas,
        ];
        return view('elegir_ofertas', $data);
    } 

    public function verABMordenes(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();

        $ordenfinalModel = new \App\Models\OrdenFinalModel();
        $ordenes = $ordenfinalModel->findAll();

        $ordenfinalprModel = new \App\Models\OrdenFinalProductosModel();
        $productos = $ordenfinalprModel->findAll();

        // Configurar la paginación
        $pager = \Config\Services::pager();
        $page = $this->request->getVar('page') ?? 1; // Obtener el número de página de la URL
        $perPage = 8; // Número de resultados por página
        $totalResults = $ordenfinalModel->countAll(); // Obtener el total de resultados

        // Set the default sort order
        $sortOrder = 'desc'; // Default to newest

        $ordenes = $ordenfinalModel->select('ordenfinal.*, users.nombres, users.apellidos')
                ->join('users', 'users.id = ordenfinal.solicitante_id')
                ->groupBy('ordenfinal.id') // Group by the unique identifier (e.g., 'id' of 'ordenesdecompra')
                ->orderBy('ordenfinal.created_at', $sortOrder) // Adjust the order here
                ->paginate($perPage, 'default', $page);

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'ordenes' => $ordenes,
            'productos' => $productos,
            'pager' => $ordenfinalModel->pager,
        ];
        return view('ABM_OrdenesCompra', $data);
    }  

    public function ver_orden_detalles($orden_id): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();

        $ordenfinalModel = new \App\Models\OrdenFinalModel();
        $orden = $ordenfinalModel->find($orden_id);

        $ordenfinalprModel = new \App\Models\OrdenFinalProductosModel();
        $productos = $ordenfinalprModel->where('ordenfinal_id', $orden_id)->findAll();

        $rubrosModel = new \App\Models\RubroModel();
        $rubros = $rubrosModel->findAll();

        $proveedoresModel = new \App\Models\ProveedorModel();
        $proveedor = $proveedoresModel->find($orden['proveedor_id']);

        $solicitante_id = $orden['solicitante_id'];
        $userModel_orden = new \App\Models\UserModelo();
        $solicitante = $userModel_orden->find($solicitante_id);

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'orden' => $orden,
            'productos' => $productos,
            'solicitante' => $solicitante,
            'rubros' => $rubros,
            'proveedor' => $proveedor,
        ];
        return view('orden_detalles', $data);
    }
}
