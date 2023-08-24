<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->setAutoRoute(true);

service('auth')->routes($routes);

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
// $routes->get('/', 'Item::index');
// // $routes->get('/home/index', 'Home::index');
// API Routes

//office api
$routes->group("api", ["filter" => "groupfilter:superadmin"], function ($routes) {
    $routes->get("office", "Office::index");
    $routes->post("office/list", "Office::getall");
    $routes->get("office/(:num)", "Office::getbyid/$1");
    $routes->post("office", "Office::create");
    $routes->put("office/(:num)", "Office::update/$1");
    $routes->delete("office/(:num)", "Office::delete/$1");
    
});

//office api
$routes->group("api", ["filter" => "apiauth"], function ($routes) {
    
    $routes->get("supportticket", "Supportticket::index");
    $routes->post("supportticket/list", "Supportticket::getall");
    $routes->get("supportticket/(:num)", "Supportticket::getbyid/$1");
    $routes->post("supportticket", "Supportticket::create");
    $routes->put("supportticket/(:num)", "Supportticket::update/$1");
    $routes->delete("supportticket/(:num)", "Supportticket::delete/$1");
});


// $routes->group('',['filter' => 'AuthAdmin'], function($routes){
//     $routes->get('/item/index', 'Item::index');
//     $routes->get('/item/add', 'Item::add');
//     $routes->post('/item/add', 'Item::add');
//     $routes->get('/item/edit', 'Item::edit');
//     $routes->get('/item/delete/(:num)', 'Item::delete/$1');
//     $routes->post('/item/delete/(:num)', 'Item::destroy/$1');
//     $routes->get('/home/index', 'Home::index');
//     $routes->get('/item/test', 'Item::test');
// });

// $routes->get('/', 'Public\Home::index');

// $routes->group('admin',['namespace' => 'App\Controller\Private'], function ($routes){
//     $routes->get('/', 'Dashboard::index');
// });




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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
