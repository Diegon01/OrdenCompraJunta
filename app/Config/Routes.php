<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\BaseController;
use App\Controllers\Home;
use App\Controllers\RubroController;
use App\Controllers\ProyectoUsersController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/alta-proveedor/crear', 'Home::proveedor_crear');
$routes->get('/permission-denied', 'Home::permission_redirect');
$routes->get('/pass-validation', 'Home::pass_val');
$routes->get('/pass-wrong', 'Home::pass_wrong');
$routes->post('/alta-proveedor/pasouno', 'Home::proveedor_crear_pasodos');
$routes->post('/alta-proveedor', 'ProveedorController::altaProveedor');
$routes->get('/alta-proveedor/exito', 'Home::proveedor_created');
$routes->get('/alta-solicitud-orden-compra/crear', 'Home::solicitud_orden_compra_crear');
$routes->get('/registrar', 'Home::usuario_crear');
$routes->get('/editar-perfil', 'Home::usuario_editar');
$routes->get('/editar-foto-perfil', 'Home::usuario_editar_foto');
$routes->get('/editar-mail', 'Home::usuario_editar_mail');
$routes->post('/alta-usuario', 'ProyectoUsersController::registerAction');
$routes->post('/editar-perfil-a', 'ProyectoUsersController::changePassAction');
$routes->post('/editar-perfil-pfp', 'ProyectoUsersController::changePFPAction');
$routes->get('/registrar/exito', 'Home::registrar_created');
$routes->get('/ordenes', 'Home::ver_ordenes');
$routes->get('/misordenes', 'Home::mis_ordenes');
$routes->get('/ordenes-botones', 'Home::ordenes_botones');
$routes->get('/administracion', 'Home::administracion');
$routes->get('/ver-rubros', 'Home::ver_rubros');
$routes->post('/alta-orden', 'OrdenDeCompraController::alta_orden_compra');
service('auth')->routes($routes, ['except' => ['/login', '/register']]);
$routes->get('/login', '\App\Controllers\Auth\LoginController::loginView');
$routes->get('/a', 'Home::a');
$routes->get('/alta-rubro', 'Home::rubro_crear');
$routes->post('/alta-rubro/crear', 'RubroController::altaRubro');
$routes->post('/contador-aprueba', 'OrdenDeCompraController::contador_aprueba');
$routes->post('/presidente-aprueba', 'OrdenDeCompraController::presidente_aprueba');
$routes->post('/presidente-autoriza', 'OrdenDeCompraController::presidente_autoriza');
$routes->post('/secretario-aprueba', 'OrdenDeCompraController::secretario_aprueba');
$routes->post('/solicitud-rechaza', 'OrdenDeCompraController::solicitud_rechaza');
$routes->post('/ingreso-oferta', 'OrdenDeCompraController::ingreso_oferta');
$routes->post('/eleccion-oferta', 'OrdenDeCompraController::eleccion_oferta');
$routes->get('/solicitud-detalles/(:num)', 'Home::ver_solicitud_detalles/$1');
$routes->get('/ver-detalle-solicitud', 'Home::verDetalle_Solicitud');
$routes->get('/ingresar-ofertas/(:num)', 'Home::ingresar_ofertas/$1');
$routes->get('/elegir-ofertas/(:num)', 'Home::elegir_ofertas/$1');
$routes->get('/ordenescompra', 'Home::verABMordenes');
$routes->get('/orden-detalles/(:num)', 'Home::ver_orden_detalles/$1');
$routes->get('/editar-rubro/(:num)', 'Home::edicion_rubro/$1');
$routes->post('/editar-rubro/aceptar', 'RubroController::editRubro');
$routes->get('/ver-proveedores', 'Home::ver_proveedores');
$routes->get('/editar-proveedor/(:num)', 'Home::edicion_proveedor/$1');
$routes->post('/editar-proveedor/aceptar', 'ProveedorController::editProv');
$routes->get('/ver-usuarios', 'Home::ver_usuarios');
$routes->get('/editar-usuario/(:num)', 'Home::edicion_usuario/$1');
$routes->post('/editar-usuario/aceptar', 'ProyectoUsersController::editUserAdmin');
$routes->get('/prueba-dgi', 'Home::prueba_dgi');