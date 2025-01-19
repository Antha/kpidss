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
    $routes->post('/quiz/timer/save', 'Quiz::saveRemainingTime');
    $routes->get('/quiz/timer/get', 'Quiz::getRemainingTime');

    $routes->get('/kpi', 'Kpi::index');
    $routes->post('/kpi', 'Kpi::index');
    $routes->post('/kpi/download_data_agent', 'Kpi::download_data_agent');
    $routes->post('/kpi/download_data_admin', 'Kpi::download_data_admin');
    $routes->get('/loyalty', 'Loyalty::index');
    $routes->post('/loyalty/upload_photo', 'Loyalty::upload_photo');
    $routes->get('/loyalty_example', 'Loyalty::index_example');
});
