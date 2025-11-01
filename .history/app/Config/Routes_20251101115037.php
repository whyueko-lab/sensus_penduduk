<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ============================
// AUTH ROUTES
// ============================
$routes->get('/', 'AuthController::index');           // halaman login
$routes->get('login', 'AuthController::index');       // login form
$routes->post('login', 'AuthController::login');      // proses login internal
$routes->get('logout', 'AuthController::logout');     // logout
$routes->post('apilogin', 'AuthController::apiLogin'); // login API (JWT)

// ============================
// SENSUS ROUTES (JWT PROTECTED)
// ============================
$routes->group('sensus', ['filter' => 'jwt'], function ($routes) {
    $routes->get('/', 'SensusController::index');             // list penduduk
    $routes->get('create', 'SensusController::create');       // form tambah
    $routes->post('store', 'SensusController::store');        // simpan penduduk
    $routes->get('edit/(:num)', 'SensusController::edit/$1'); // form edit
    $routes->post('update/(:num)', 'SensusController::update/$1'); // update
    $routes->delete('delete/(:num)', 'SensusController::delete/$1'); // hapus

    // tambahan
    $routes->post('addProvinsi', 'SensusController::addProvinsi');
    $routes->post('addKota', 'SensusController::addKota');
});

// ============================
// KOTA ROUTES (JWT PROTECTED)
// ============================
$routes->group('kota', ['filter' => 'jwt'], function ($routes) {
    $routes->get('/', 'KotaController::index');                 // semua kota
    $routes->get('(:num)', 'KotaController::byProvinsi/$1');  // kota by provinsi
    $routes->post('store', 'KotaController::store');           // tambah kota
    $routes->put('update/(:num)', 'KotaController::update/$1'); // update kota (opsional)
    $routes->delete('delete/(:num)', 'KotaController::delete/$1'); // hapus kota (opsional)
});

// ============================
// PROVINSI ROUTES (JWT PROTECTED)
// ============================
$routes->group('provinsi', ['filter' => 'jwt'], function ($routes) {
    $routes->get('/', 'ProvinsiController::index');                 // semua provinsi
    $routes->post('store', 'ProvinsiController::store');            // tambah provinsi
    $routes->put('update/(:num)', 'ProvinsiController::update/$1'); // update provinsi
    $routes->delete('delete/(:num)', 'ProvinsiController::delete/$1'); // hapus provinsi
});
