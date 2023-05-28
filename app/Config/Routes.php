<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Authentication Routing ---- Removed 


$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
//! Articles Routing
$routes->get('/create_Article', 'ArticlesController::create_Article');


$routes->post('/add_Article', 'ArticlesController::add_Article');


$routes->get('/show_Articles', 'ArticlesController::show_Articles');
$routes->get('/show_Articles/M', 'ArticlesController::show_Writers_Articles');

$routes->get('/show_Article/(:num)', 'ArticlesController::show_Article/$1');


$routes->get('/modify_Article/(:num)', 'ArticlesController::modify_Article/$1');




$routes->get('/articles/not_found', 'ArticlesController::not_found');
//! Users Routing
$routes->get('/profile', 'UserController::show_Profile');

//! Login Routing
$routes->get('/login', 'Login::index');
$routes->get('login_redir', 'Login::loginRedirect');
$routes->get('/logout', 'Login::logout');
/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
