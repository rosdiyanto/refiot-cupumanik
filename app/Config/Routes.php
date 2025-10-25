<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
    return redirect()->to('login');
});


$routes->get('home', 'Home::index');

// bawaan shield
service('auth')->routes($routes);

$routes->get('/berhasil-login', 'Berhasil::infoLogin');
$routes->get('/berhasil-register', 'Berhasil::infoRegister');

$routes->group('admin', ['namespace' => 'App\Modules\Admin\Controllers'], function ($routes) {
// $routes->group('admin', ['namespace' => 'App\Modules\Admin\Controllers', 'filter' => 'group:admin'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('user', 'UserController::index');
    $routes->get('user/getdata', 'UserController::getData');
    $routes->get('pegawai', 'PegawaiController::index');
    $routes->get('pegawai/getdata', 'PegawaiController::getData');
    $routes->get('rfid', 'RfidController::index');
    $routes->get('rfid/getdata', 'RfidController::getData');
});

$routes->group('datatables', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'DatatablesController::index');
    $routes->get('data', 'DatatablesController::getData');
    $routes->get('create', 'DatatablesController::create');
    $routes->post('store', 'DatatablesController::store');
    $routes->get('edit/(:num)', 'DatatablesController::edit/$1');
    $routes->post('update/(:num)', 'DatatablesController::update/$1');
    $routes->get('delete/(:num)', 'DatatablesController::delete/$1');
    $routes->get('ceking', 'DatatablesController::ceking');
});

$routes->get('/testemail', 'TestEmail::index');
