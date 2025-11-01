<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/sensus', 'SensusController::index');
$routes->get('/sensus/create', 'SensusController::create');
$routes->post('/sensus/store', 'SensusController::store');
$routes->get('/sensus/edit/(:num)', 'SensusController::edit/$1');
$routes->post('/sensus/update/(:num)', 'SensusController::update/$1');
$routes->get('/sensus/delete/(:num)', 'SensusController::delete/$1');

$routes->post('sensus/addProvinsi', 'SensusController::addProvinsi');
$routes->post('sensus/addKota', 'SensusController::addKota');
$routes->post('/provinsi/store', 'ProvinsiController::store');
$routes->post('/kota/store', 'KotaController::store');



