<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes){
  $routes->post('auth/login', 'AuthController::login');
  $routes->post('auth/register', 'AuthController::register');

  $routes->get('sensus', 'SensusController::index');
  $routes->post('sensus', 'SensusController::create');
  $routes->put('sensus/(:num)', 'SensusController::update/$1');
  $routes->delete('sensus/(:num)', 'SensusController::delete/$1');

  $routes->get('kota', 'KotaController::index');
  $routes->post('kota', 'KotaController::create');
  $routes->put('kota/(:num)', 'KotaController::update/$1');
  $routes->delete('kota/(:num)', 'KotaController::delete/$1');
});
