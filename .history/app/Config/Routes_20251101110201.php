<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ✅ Halaman utama diarahkan ke AuthController::index
$routes->get('/', 'AuthController::index');

// ✅ Route untuk autentikasi
$routes->get('login', 'AuthController::index'); // gunakan index untuk tampilan login
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

// ✅ Group route untuk fitur sensus — dilindungi filter JWT
$routes->group('sensus', ['filter' => 'jwt'], function ($routes) {
    $routes->get('/', 'SensusController::index');
    $routes->get('create', 'SensusController::create');
    $routes->post('store', 'SensusController::store');
    $routes->get('edit/(:num)', 'SensusController::edit/$1');
    $routes->post('update/(:num)', 'SensusController::update/$1');
    $routes->get('delete/(:num)', 'SensusController::delete/$1');

    // ✅ Endpoint tambahan tetap terlindungi
    $routes->post('addProvinsi', 'SensusController::addProvinsi');
    $routes->post('addKota', 'SensusController::addKota');
});

// ✅ Route tambahan (jika ada controller khusus)
$routes->get('kota', 'KotaController::index');            
$routes->get('kota/(:num)', 'KotaController::byProvinsi/$1'); 
$routes->post('kota/store', 'KotaController::store');    