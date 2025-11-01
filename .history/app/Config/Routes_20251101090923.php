<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ✅ Halaman utama diarahkan ke form login
$routes->get('/', 'AuthController::login');

// ✅ Route untuk autentikasi
$routes->get('login', 'AuthController::login');
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

    // ✅ Tambahkan juga endpoint tambahan terkait sensus di sini agar tetap terlindungi JWT
    $routes->post('addProvinsi', 'SensusController::addProvinsi');
    $routes->post('addKota', 'SensusController::addKota');
});

// ✅ Route tambahan (jika ada controller khusus)
$routes->post('provinsi/store', 'ProvinsiController::store');
$routes->post('kota/store', 'KotaController::store');
