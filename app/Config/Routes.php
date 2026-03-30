<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Load the system's routing file first
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Frontend Routes
$routes->get('/', 'Home::index');
$routes->post('submit-inquiry', 'Home::submitInquiry');

// API Routes
$routes->post('api/leads/create', 'Api\Leads::create');

// Admin Routes - Set namespace for Admin group
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    
    // Public Admin Routes (NO adminauth filter)
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::attemptLogin');
    $routes->get('logout', 'Auth::logout');
    
    // Protected Admin Routes (WITH adminauth filter)
    // Apply filter to specific routes, not the group
    $routes->get('/', 'Dashboard::index', ['filter' => 'adminauth']);
    $routes->get('dashboard', 'Dashboard::index', ['filter' => 'adminauth']);
    
    // Leads Management
    $routes->get('leads', 'Leads::index', ['filter' => 'adminauth']);
    $routes->get('leads/view/(:num)', 'Leads::view/$1', ['filter' => 'adminauth']);
    $routes->post('leads/delete/(:num)', 'Leads::delete/$1', ['filter' => 'adminauth']);
    $routes->get('leads/export', 'Leads::export', ['filter' => 'adminauth']);
    $routes->post('leads/bulk-delete', 'Leads::bulkDelete', ['filter' => 'adminauth']);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}