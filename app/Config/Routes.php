<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\BaseController;
use App\Controllers\Home;
use App\Controllers\RubroController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('rubro/insert', 'RubroController::insertRubro');
$routes->get('/rubro/created', 'Home::rubro_created');
