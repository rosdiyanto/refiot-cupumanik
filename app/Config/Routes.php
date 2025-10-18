<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);
$routes->get('/berhasil-login', 'Berhasil::infoLogin');
$routes->get('/berhasil-register', 'Berhasil::infoRegister');
