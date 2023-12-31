<?php

namespace App\Controllers;
use App\Models\OrdenDeCompraModel;
use App\Models\ProveedorModel;
use App\Models\ProductoDeOrdenDeCompraModel;
use CodeIgniter\Pager\Pager;
use App\Models\UserModelo;
use App\Models\RubroModel;
use App\Models\RubroSaldoCongeladoModel;
use App\Models\OrdenProveedorModel;
use App\Models\OfertaModel;
use CodeIgniter\Language\Language;


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
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        if ($isFuncionario) {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return $this->ordenes_botones();
        }
        else {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('permission_denied', $data);
        }
    }
    public function proveedor_created(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        if ($isFuncionario) {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('proveedor_exito', $data);
        }
        else {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('permission_denied', $data);
        }
    }
    public function proveedor_crear(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        if ($isContador || $isAdmin) {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('alta_proveedor', $data);
        }
        else {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('permission_denied', $data);
        }
    }
    public function proveedor_crear_pasodos(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        $rut = $this->request->getPost('rut');

        $proveedorModel = new ProveedorModel();

        $existeProveedor = $proveedorModel->where('RUT', $this->request->getPost('rut'))->countAllResults() > 0;

        if ($existeProveedor) {
            // Puedes manejar la lógica para el caso de que el proveedor ya exista
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('rut_existe', $data);
        }

        $accessToken = $this->obtenerToken();
        $rutEmisor = '214198620015';
        $datosRUT = $this->obtenerDatosRUT($rut, $accessToken, $rutEmisor);
        $nombre = null;
        $numero = null;
        $contactos = [];

        $contactos = [];

        // Verificar si el nivel WS_PersonaActEmpresarial existe
        if (isset($datosRUT['WS_PersonaActEmpresarial'])) {
            $domFiscalLocPrincipal = $datosRUT['WS_PersonaActEmpresarial']['WS_DomFiscalLocPrincipal'];
            $nombre = $datosRUT['WS_PersonaActEmpresarial']['Denominacion'];
            $estadoActividad = $datosRUT['WS_PersonaActEmpresarial']['EstadoActividad'];

            // Verificar si el nivel WS_DomFiscalLocPrincipal existe
            if (isset($domFiscalLocPrincipal['WS_PersonaActEmpresarial.WS_DomFiscalLocPrincipalItem'])) {
                $contactosData = $domFiscalLocPrincipal['WS_PersonaActEmpresarial.WS_DomFiscalLocPrincipalItem'];

                // Verificar si Contactos es un array y contiene WS_Domicilio.WS_DomicilioItem.Contacto
                if (isset($contactosData['Contactos']) && is_array($contactosData['Contactos']) && isset($contactosData['Contactos']['WS_Domicilio.WS_DomicilioItem.Contacto'])) {
                    $contactos = $contactosData['Contactos']['WS_Domicilio.WS_DomicilioItem.Contacto'];
                }
            }

        }
        else {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('rut_no_existe', $data);
        }

        if (is_array($contactos)) {
            foreach ($contactos as $contacto) {
                if (is_array($contacto)) {
                    if ($contacto['TipoCtt_Des'] === 'TELEFONO FIJO') {
                        $numero = $contacto['DomCtt_Val'];
                        break;
                    }
                }
                else {
                    if ($contactos['TipoCtt_Des'] === 'TELEFONO FIJO') {
                        $numero = $contactos['DomCtt_Val'];
                        break;
                    }
                }
            }
        }
        else {
            if ($contactos['TipoCtt_Des'] === 'TELEFONO FIJO') {
                $numero = $contactos['DomCtt_Val'];
            }
        }

        if ($isContador || $isAdmin) {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'rut' => $rut,
                'nombre' => $nombre,
                'numero' => $numero,
                'estadoActividad' => $estadoActividad,
                'usuario' => $logged,
            ];
            return view('alta_proveedor_pasodos', $data);
        }
        else {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('permission_denied', $data);
        }
    }
    public function solicitud_orden_compra_crear(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        if ($isFuncionario) {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('alta_solicitudOrdenCompra', $data);
        }
        else {
            return $this->permission_redirect();
        }
    }
    public function permission_redirect(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'usuario' => $logged,
        ];
        return view('permission_denied', $data);
    }
    public function pass_wrong(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'usuario' => $logged,
        ];
        return view('pass_same_error', $data);
    }
    public function pass_val(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'usuario' => $logged,
        ];
        return view('pass_validation_error', $data);
    }
    public function usuario_crear(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        if ($isAdmin) {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('alta_usuario', $data);
        }
        else {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('permission_denied', $data);
        }
    }

    public function registrar_created(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'usuario' => $logged,
        ];
        return view('registro_exito', $data);
    }

    public function ordenes_botones(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        if ($isFuncionario) {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('solicitudes_botones', $data);
        }
        else {
            return $this->permission_redirect();
        }
    }

    public function administracion(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        if ($isAdmin || $isContador) {
            $data = [
                'isAdmin' => $isAdmin,
                'isFuncionario' => $isFuncionario,
                'isContador' => $isContador,
                'isPresidente' => $isPresidente,
                'isSecretario' => $isSecretario,
                'usuario' => $logged,
            ];
            return view('administracion', $data);
        }
        else {
            return $this->permission_redirect();
        }
        
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
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);
        $currentUserId = auth()->user()->id;

        if (!$isAdmin && !$isContador && !$isPresidente && !$isSecretario) {
            return $this->permission_redirect();
        }
         // Cargar el modelo
         $ordenCompraModel = new \App\Models\OrdenDeCompraModel();


        // ...

        // Establece el idioma a español
        $language = new Language('es');
        $language->setLocale('es');

         // Configurar la paginación
         $pager = \Config\Services::pager();
         $page = $this->request->getVar('page') ?? 1; // Obtener el número de página de la URL
         $perPage = 12; // Número de resultados por página
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
             'usuario' => $logged,
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
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        $currentUserId = auth()->user()->id;

        if (!$isFuncionario) {
            return $this->permission_redirect();
        }

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
             'usuario' => $logged,
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
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        if (!$isAdmin && !$isContador) {
            return $this->permission_redirect();
        }

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'usuario' => $logged,
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

        if (!$isAdmin && !$isContador && !$isPresidente && !$isSecretario) {
            return $this->permission_redirect();
        }

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'usuario' => $logged,
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
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
        $orden = $ordenCompraModel->find($orden_id);

        if ((!$isAdmin && !$isContador && !$isPresidente && !$isSecretario) && (auth()->user()->id != $orden['solicitante_id'])) {
            return $this->permission_redirect();
        }

        $productoOrdenCompraModel = new \App\Models\ProductoDeOrdenDeCompraModel();
        $productos = $productoOrdenCompraModel->where('orden_id', $orden_id)->findAll();

        $enlaceModel = new \App\Models\OrdenProveedorModel();
        $enlaces = $enlaceModel->where('orden_id', $orden_id)->findAll();

        $rubrosModel = new \App\Models\RubroModel();
        $rubros = $rubrosModel->findAll();

        $proveedoresModel = new \App\Models\ProveedorModel();
        $proveedores = $proveedoresModel->findAll();

        $estadoActividades= [];
        $accessToken = $this->obtenerToken();
        foreach ($proveedores as $proveedore) {
            $rutEmisor = '214198620015';
            $datosRUT = $this->obtenerDatosRUT($proveedore['RUT'], $accessToken, $rutEmisor);

            // Verificar si el nivel WS_PersonaActEmpresarial existe
            if (isset($datosRUT['WS_PersonaActEmpresarial'])) {
                $estadoActividades[$proveedore['id']] = $datosRUT['WS_PersonaActEmpresarial']['EstadoActividad'];
            }
        }

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
            'estadoActividades' => $estadoActividades,
            'usuario' => $logged,
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
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        $ordenCompraModel = new \App\Models\OrdenDeCompraModel();
        $orden = $ordenCompraModel->find($orden_id);

        if ($orden['licitacion'] === '1') {
            if (!$isContador) {
                return $this->permission_redirect();
            }
        }
        if ($orden['licitacion'] === '0') {
            if ((auth()->user()->id != $orden['solicitante_id']) && (!$isContador)) {
                return $this->permission_redirect();
            }
        }

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
            'usuario' => $logged,
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
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        if (!$isPresidente) {
            return $this->permission_redirect();
        }

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
            'usuario' => $logged,
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
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        if (!$isAdmin && !$isContador && !$isPresidente && !$isSecretario) {
            return $this->permission_redirect();
        }

        $ordenfinalModel = new \App\Models\OrdenFinalModel();
        $ordenes = $ordenfinalModel->findAll();

        $ordenfinalprModel = new \App\Models\OrdenFinalProductosModel();
        $productos = $ordenfinalprModel->findAll();

        // Configurar la paginación
        $pager = \Config\Services::pager();
        $page = $this->request->getVar('page') ?? 1; // Obtener el número de página de la URL
        $perPage = 8; // Número de resultados por página
        $totalResults = $ordenfinalModel->countAll(); // Obtener el total de resultados

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
 
         $estadoFiltro = '2';
 
         if ($estado === 'pendiente') {
             $estadoFiltro = '0';
         }
 
         if ($estado === 'lista') {
             $estadoFiltro = '1';
         }

         if ($estadoFiltro === '2') {
            $ordenes = $ordenfinalModel->select('ordenfinal.*, users.nombres, users.apellidos')
                ->join('users', 'users.id = ordenfinal.solicitante_id')
                ->groupStart()
                    ->like("DATE(ordenfinal.created_at)", $searchQuery) // Replace 'column_name' with the actual column you want to search in
                    ->orLike("CONCAT(users.nombres, ' ', users.apellidos)", $searchQuery) // Search in the combined 'nombres' and 'apellidos' columns
                    ->orGroupStart()
                        ->select('nombre')
                        ->from('ordenfinal_productos')
                        ->where('ordenfinal_productos.ordenfinal_id = ordenfinal.id')
                        ->like('nombre', $searchQuery) // Search for 'product_name' in 'productos' table
                    ->groupEnd()
                ->groupEnd()
                ->groupBy('ordenfinal.id') // Group by the unique identifier (e.g., 'id' of 'ordenesdecompra')
                ->orderBy('ordenfinal.created_at', $sortOrder) // Adjust the order here
                ->paginate($perPage, 'default', $page);
         }
         else {
            $ordenes = $ordenfinalModel->select('ordenfinal.*, users.nombres, users.apellidos')
                ->join('users', 'users.id = ordenfinal.solicitante_id')
                ->groupStart()
                    ->like("DATE(ordenfinal.created_at)", $searchQuery) // Replace 'column_name' with the actual column you want to search in
                    ->orLike("CONCAT(users.nombres, ' ', users.apellidos)", $searchQuery) // Search in the combined 'nombres' and 'apellidos' columns
                    ->orGroupStart()
                        ->select('nombre')
                        ->from('ordenfinal_productos')
                        ->where('ordenfinal_productos.ordenfinal_id = ordenfinal.id')
                        ->like('nombre', $searchQuery) // Search for 'product_name' in 'productos' table
                    ->groupEnd()
                ->groupEnd()
                ->where('secretario_visto', $estadoFiltro)
                ->groupBy('ordenfinal.id') // Group by the unique identifier (e.g., 'id' of 'ordenesdecompra')
                ->orderBy('ordenfinal.created_at', $sortOrder) // Adjust the order here
                ->paginate($perPage, 'default', $page);
         }

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'ordenes' => $ordenes,
            'productos' => $productos,
            'pager' => $ordenfinalModel->pager,
            'usuario' => $logged,
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
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        if (!$isAdmin && !$isContador && !$isPresidente && !$isSecretario) {
            return $this->permission_redirect();
        }

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

        $accessToken = $this->obtenerToken();
        $rutEmisor = '214198620015';
        $datosRUT = $this->obtenerDatosRUT($proveedor['RUT'], $accessToken, $rutEmisor);

        $estadoActividad = null;
        // Verificar si el nivel WS_PersonaActEmpresarial existe
        if (isset($datosRUT['WS_PersonaActEmpresarial'])) {
            $estadoActividad = $datosRUT['WS_PersonaActEmpresarial']['EstadoActividad'];
        }

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
            'estadoActividad' => $estadoActividad,
            'usuario' => $logged,
        ];
        return view('orden_detalles', $data);
    }

    function prueba_dgi() {
        $accessToken = $this->obtenerToken();
        $rut = '170037740013';
        $rutEmisor = '214198620015';

        $datosRUT = $this->obtenerDatosRUT($rut, $accessToken, $rutEmisor);

        $this->imprimirRecursivo($datosRUT);

        //$notificacionController = new \App\Controllers\NotificacionController();
        //$destino = 'santiago.sosa.m@estudiantes.utec.edu.uy';
        //$notificacionController->correoPrueba($destino);

        return ' ';

    }

    function imprimirRecursivo($array, $nivel = 0, $padre = null) {
        foreach ($array as $clave => $valor) {
            
            if (is_array($valor)) {
                echo '<br>';
                echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $nivel); // Espacios para indentación
                echo "[ $clave ] \n";
                $this->imprimirRecursivo($valor, $nivel + 1, $clave);
            } else {
                echo '<br>';
                echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $nivel);
                echo "$clave => $valor \n";
            }
        }
    }

    function obtenerToken() {
        $url = 'https://auth-test.facturaelectronica.com.uy/token';
    
        $data = [
            'username' => 'api-test@isbo.edu.uy',
            'password' => 'Isb0.test',
            'grant_type' => 'password',
            'scope' => '214198620015',
        ];

        $jsonData = json_encode($data);

        $body = '{

            "username": "api-test@isbo.edu.uy",
        
            "password": "Isb0.test",
        
            "grant_type": "password",
        
            "scope": "214198620015"
        
        }';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
    
    
        $response = curl_exec($ch);
        $tokenData = json_decode($response, true);
    
        if (isset($tokenData['access_token'])) {
            return $tokenData['access_token'];
        } else {

        }
    }

    function obtenerDatosRUT($rut, $accessToken, $rutEmisor) {
        $url = "https://api-test.facturaelectronica.com.uy/consulta-dgi/actividad-empresarial/{$rut}";
    
        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Accept: application/json',
            "x-emisor: {$rutEmisor}",
        ];
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $response = curl_exec($ch);
        $datosRUT = json_decode($response, true);
    
        // Puedes manejar los datos de respuesta según tus necesidades
    
        return $datosRUT;
    }

    public function usuario_editar(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();

        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'usuario' => $logged,
        ];
        return view('editar_usuario', $data);
    }

    public function usuario_editar_foto(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();

        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'usuario' => $logged,
        ];
        return view('editar_usuario_foto', $data);
    }

    public function usuario_editar_mail(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();

        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'usuario' => $logged,
        ];
        return view('editar_usuario_mail', $data);
    }

    public function ver_rubros(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        if (!$isAdmin && !$isContador) {
            return $this->permission_redirect();
        }

        $rubrosModel = new \App\Models\RubroModel();
        $rubros = $rubrosModel->findAll();
        $rubroconModel = new RubroSaldoCongeladoModel();
        $rubros_con = $rubroconModel->findAll();

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'rubros' => $rubros,
            'rubros_con' => $rubros_con,
            'usuario' => $logged,
        ];
        return view('ABM_Rubros', $data);
    }

    public function ver_proveedores(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        if (!$isAdmin && !$isContador) {
            return $this->permission_redirect();
        }

        $proveedorModel = new \App\Models\ProveedorModel();
        $proveedores = $proveedorModel->findAll();

        $estadoActividades= [];
        $accessToken = $this->obtenerToken();
        foreach ($proveedores as $proveedore) {
            $rutEmisor = '214198620015';
            $datosRUT = $this->obtenerDatosRUT($proveedore['RUT'], $accessToken, $rutEmisor);

            // Verificar si el nivel WS_PersonaActEmpresarial existe
            if (isset($datosRUT['WS_PersonaActEmpresarial'])) {
                $estadoActividades[$proveedore['id']] = $datosRUT['WS_PersonaActEmpresarial']['EstadoActividad'];
            }
        }

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'proveedores' => $proveedores,
            'estadoActividades' => $estadoActividades,
            'usuario' => $logged,
        ];
        return view('ABM_Proveedores', $data);
    }

    public function ver_usuarios(): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        if (!$isAdmin) {
            return $this->permission_redirect();
        }

        $userModel = new \App\Models\UserModelo();
        $usuarios = $userModel
            ->select('users.*, auth_identities.secret, user_roles.*')
            ->join('auth_identities', 'auth_identities.user_id = users.id')
            ->join('user_roles', 'user_roles.user_id = users.id')
            ->findAll();

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'usuarios' => $usuarios,
            'usuario' => $logged,
        ];
        return view('ABM_Usuarios', $data);
    }

    public function edicion_rubro($rubro_codigo): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        if (!$isAdmin && !$isContador) {
            return $this->permission_redirect();
        }

        $rubrosModel = new \App\Models\RubroModel();
        $rubro = $rubrosModel->find($rubro_codigo);
        $rubroconModel = new \App\Models\RubroSaldoCongeladoModel();
        $rubro_con = $rubroconModel->find($rubro_codigo);

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'rubro' => $rubro,
            'rubro_con' => $rubro_con,
            'usuario' => $logged,
        ];
        return view('editar_rubro', $data);
    }

    public function edicion_proveedor($prov_codigo): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        if (!$isAdmin && !$isContador) {
            return $this->permission_redirect();
        }

        $proveedorModel = new \App\Models\ProveedorModel();
        $proveedor = $proveedorModel->find($prov_codigo);

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'proveedor' => $proveedor,
            'usuario' => $logged,
        ];
        return view('editar_proveedor', $data);
    }

    public function edicion_usuario($user_id): string 
    {
        $userModelo = new \App\Models\UserModelo(); // Necesario en todas las vistas
        $isAdmin = $userModelo->isAdmin();
        $isFuncionario = $userModelo->isFuncionario();
        $isContador = $userModelo->isContador();
        $isPresidente = $userModelo->isPresidente();
        $isSecretario = $userModelo->isSecretario();
        $currentUserId = auth()->user()->id;
        $userModel_own = new \App\Models\UserModelo();
        $logged = $userModel_own->find($currentUserId);

        if (!$isAdmin) {
            return $this->permission_redirect();
        }

        $newUserModelo = new \App\Models\UserModelo();
        $usuario = $newUserModelo
            ->select('users.*, auth_identities.secret, user_roles.*')
            ->join('auth_identities', 'auth_identities.user_id = users.id')
            ->join('user_roles', 'user_roles.user_id = users.id')
            ->where('users.id', $user_id)
            ->first();

        $data = [
            'isAdmin' => $isAdmin,
            'isFuncionario' => $isFuncionario,
            'isContador' => $isContador,
            'isPresidente' => $isPresidente,
            'isSecretario' => $isSecretario,
            'usuario_a' => $usuario,
            'usuario' => $logged,
        ];
        return view('editar_usuario_admin', $data);
    }
}
