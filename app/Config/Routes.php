<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::loginView');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/weather', 'WeatherController::index');
$routes->get('/dashboard', 'WeatherController::index');
$routes->get('/weather/analytics', 'WeatherController::analytics');
$routes->get('/weather/create', 'WeatherController::create');
$routes->post('/weather/store', 'WeatherController::store');
$routes->get('/weather/edit/(:num)', 'WeatherController::edit/$1');
$routes->post('/weather/update/(:num)', 'WeatherController::update/$1');
$routes->get('/weather/delete/(:num)', 'WeatherController::delete/$1');




