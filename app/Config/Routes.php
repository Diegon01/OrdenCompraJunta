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
$routes->get('/alta-orden-compra/crear', 'Home::orden_compra_crear');
$routes->get('/registrar', 'Home::usuario_crear');
$routes->post('/alta-usuario', 'ProyectoUsersController::registerAction');
$routes->get('/registrar/exito', 'Home::registrar_created');
$routes->get('/ordenes', 'Home::ver_ordenes');
$routes->post('/alta-orden', 'OrdenDeCompraController::alta_orden_compra');
service('auth')->routes($routes, ['except' => ['/login', '/register']]);
$routes->get('/login', '\App\Controllers\Auth\LoginController::loginView');
$routes->get('/a', 'Home::a');