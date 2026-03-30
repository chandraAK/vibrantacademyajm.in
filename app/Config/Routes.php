<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Frontend Routes
$routes->get('/', 'Home::index');
$routes->post('submit-inquiry', 'Home::submitInquiry');

// API Routes for AJAX
$routes->post('api/leads/create', 'Api\Leads::create');

// Admin Routes
$routes->group('admin', function ($routes) {
    // Auth
    $routes->get('login', 'Admin\Auth::login');
    $routes->post('login', 'Admin\Auth::attemptLogin');
    $routes->get('logout', 'Admin\Auth::logout');
    
    // Protected Routes
    $routes->group('', ['filter' => 'adminauth'], function ($routes) {
        $routes->get('/', 'Admin\Dashboard::index');
        $routes->get('dashboard', 'Admin\Dashboard::index');
        
        // Leads Management
        $routes->get('leads', 'Admin\Leads::index');
        $routes->get('leads/view/(:num)', 'Admin\Leads::view/$1');
        $routes->post('leads/delete/(:num)', 'Admin\Leads::delete/$1');
        $routes->get('leads/export', 'Admin\Leads::export');
        $routes->post('leads/bulk-delete', 'Admin\Leads::bulkDelete');
    });
});