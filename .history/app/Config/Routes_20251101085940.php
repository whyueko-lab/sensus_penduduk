<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->post('/login', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');


$routes->group('sensus', ['filter' => 'jwt'], function($routes) {
    $routes->get('/', 'login::index');
    $routes->get('create', 'SensusController::create');
    $routes->post('store', 'SensusController::store');
    $routes->get('edit/(:num)', 'SensusController::edit/$1');
    $routes->post('update/(:num)', 'SensusController::update/$1');
    $routes->get('delete/(:num)', 'SensusController::delete/$1');
});

$routes->post('sensus/addProvinsi', 'SensusController::addProvinsi');
$routes->post('sensus/addKota', 'SensusController::addKota');
$routes->post('/provinsi/store', 'ProvinsiController::store');
$routes->post('/kota/store', 'KotaController::store');




