<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/pnp_test', 'Pnp_test::index');
$routes->get('/kpi', 'Kpi::index');
$routes->post('/kpi', 'Kpi::index');
