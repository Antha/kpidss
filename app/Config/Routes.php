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
    $routes->post('/kpi/download_data_agent_branch', 'Kpi::download_data_agent_branch');
    $routes->post('/kpi/download_data_agent_cluster', 'Kpi::download_data_agent_cluster');
    $routes->post('/kpi/download_data_admin', 'Kpi::download_data_admin');
    $routes->get('/loyalty', 'Loyalty::index');
    $routes->get('/loyalty_input', 'Loyalty::input_data');
    $routes->post('/loyalty_upload', 'Loyalty::upload_data');
    $routes->post('/loyalty/upload_photo', 'Loyalty::upload_photo');
    $routes->get('/loyalty_example', 'Loyalty::index_example');
    $routes->post('/loyalty/cek_redeem_point', 'Loyalty::cek_redeem_point');
    $routes->post('/loyalty/redeem_process', 'Loyalty::redeem_process');

    $routes->get('/questions', 'QuestionController::index');
    $routes->post('/questions/import', 'QuestionController::import');
    $routes->get('/questions/sample-csv', 'QuestionController::sampleCsv');

});
