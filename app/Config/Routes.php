<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/logout', 'Login::logout');
    $routes->get('/dashboard', 'Dashboard::index');
    $routes->get('/pnp_test', 'Pnp_test::index');

    $routes->get('camera', 'Camera::index');
    $routes->post('camera/save', 'Camera::save');
    $routes->get('/quiz', 'Quiz::index');
    $routes->post('/quiz/(:num)', 'Quiz::index/$1');
    $routes->get('/quiz/result', 'Quiz::result');
    $routes->get('/kpi', 'Kpi::index');
    $routes->post('/kpi', 'Kpi::index');
});
