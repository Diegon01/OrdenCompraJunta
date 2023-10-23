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
$routes->post('/alta-proveedor', 'ProveedorController::altaProveedor');
$routes->get('/alta-proveedor/exito', 'Home::proveedor_created');
$routes->get('/alta-solicitud-orden-compra/crear', 'Home::solicitud_orden_compra_crear');
$routes->get('/registrar', 'Home::usuario_crear');
$routes->post('/alta-usuario', 'ProyectoUsersController::registerAction');
$routes->get('/registrar/exito', 'Home::registrar_created');
$routes->get('/ordenes', 'Home::ver_ordenes');
$routes->get('/misordenes', 'Home::mis_ordenes');
$routes->post('/alta-orden', 'OrdenDeCompraController::alta_orden_compra');
service('auth')->routes($routes, ['except' => ['/login', '/register']]);
$routes->get('/login', '\App\Controllers\Auth\LoginController::loginView');
$routes->get('/a', 'Home::a');
$routes->get('/alta-rubro/crear', 'Home::rubro_crear');
$routes->post('/contador-aprueba', 'OrdenDeCompraController::contador_aprueba');
$routes->post('/presidente-aprueba', 'OrdenDeCompraController::presidente_aprueba');
$routes->post('/solicitud-rechaza', 'OrdenDeCompraController::solicitud_rechaza');