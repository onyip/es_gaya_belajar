<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');

$routes->group('gaya-belajar', function ($routes) {
    $routes->get('/', 'GayaBelajar::index');
    $routes->post('list', 'GayaBelajar::listData');
    $routes->post('create', 'GayaBelajar::create');
    $routes->get('show/(:num)', 'GayaBelajar::show/$1');
    $routes->post('update/(:num)', 'GayaBelajar::update/$1');
    $routes->delete('delete/(:num)', 'GayaBelajar::delete/$1');
});
