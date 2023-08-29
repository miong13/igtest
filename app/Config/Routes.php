<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
$routes->add('register', 'Register::index');
$routes->add('register/add', 'Register::add');
$routes->add('dashboard/', 'Dashboard::index');
$routes->add('dashboard/login', 'Dashboard::login');
$routes->add('dashboard/logout', 'Dashboard::logout');
$routes->add('dashboard/inventory', 'Inventory::index');
$routes->add('dashboard/users', 'Users::index');
$routes->add('dashboard/users/add', 'Users::add');
$routes->add('dashboard/users/delete', 'Users::delete');
$routes->add('dashboard/users/edit', 'Users::edit');
$routes->add('api/listemployee', 'Api::listEmployee');
$routes->add('api/employee', 'Api::employeeByEmail');
// $routes->add('api/register', 'Api::addEmployee');
$routes->add('api/addemployee', 'Api::addEmployee');
$routes->add('api/updateemployee', 'Api::editEmployee');
$routes->add('api/deleteemployee', 'Api::deleteEmployee');
$routes->add('api/register', 'Api::registerWithPhoto');
$routes->add('api/signin', 'Api::signin');

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
