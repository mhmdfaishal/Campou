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
$routes->setDefaultController('Login');
$routes->setDefaultMethod('home');
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

$routes->get('/', 'Login::home');

$routes->get('login', 'Login::loginidx');
$routes->get('logout', 'Login::logout');
$routes->get('logoutadmin', 'Login::logoutadmin');
$routes->get('loginadmin', 'Login::loginadmin');
$routes->post('/afterlogin', 'Login::index');
$routes->post('/admin/login', 'Login::indexadmin');
$routes->post('/login/forgotpage', 'Login::forgotpage');
$routes->post('sendemail', 'Login::sendEmail');
$routes->get('/verifyandchange/(:alphanum)', 'Login::verifyandchange/$1');
$routes->post('/createnewpassword', 'Login::createnewpassword');

$routes->get('/customer/deletepenyewaan/(:num)', 'Homepage::deletePenyewaanCust/$1');

$routes->get('/admin/editpenyewaan/(:num)/(:alphanum)', 'Homepage::editPenyewaan/$1/$2',['filter' => 'auth']);
$routes->get('/admin/deletepenyewaan/(:num)', 'Homepage::deletePenyewaanAdmin/$1');
$routes->get('/admin/editcustomer/(:alphanum)', 'Homepage::editCustomer/$1',['filter' => 'auth']);
$routes->get('/admin/deletecustomer/(:alphanum)', 'Homepage::deletepelanggan/$1');
$routes->get('/admin/editlapangan/(:alphanum)', 'Homepage::editLapangan/$1',['filter' => 'auth']);
$routes->get('/admin/deletelapangan/(:alphanum)', 'Homepage::deleteLapangan/$1');
$routes->get('/admin/tambahlapangan', 'Homepage::tambahlapangan');
$routes->get('/admin/tambahadmin', 'Homepage::tambahadmin',['filter' => 'auth']);
$routes->get('/admin/edit/(:num)', 'Homepage::editadmin/$1',['filter' => 'auth']);
$routes->get('/admin/delete/(:num)', 'Homepage::deleteadmin/$1',['filter' => 'auth']);
$routes->post('/createadmin', 'Homepage::createadmin');
$routes->post('/createlapangan', 'Homepage::createlapangan');

$routes->get('/admin/homepage', 'Homepage::indexadmin',['filter' => 'auth']);
$routes->get('/daftarcustomer', 'Homepage::indexcustomer',['filter' => 'auth']);
$routes->get('/admin', 'Homepage::daftaradmin',['filter' => 'auth']);
$routes->get('/daftarlapangan', 'Homepage::daftarlapangan',['filter' => 'auth']);
$routes->get('/daftarpenyewaan', 'Homepage::getPenyewaanByUsername',['filter' => 'auth']);
$routes->get('/daftarpenyewaancust/(:alphanum)', 'Homepage::getPenyewaanByIdLapangan/$1',['filter' => 'auth']);

$routes->match(['get','post'], 'register', 'Login::register');
$routes->get('dashboard', 'Homepage::index',['filter' => 'auth']);

$routes->post('updatepenyewaan', 'Homepage::updatePenyewaan');
$routes->post('updatecustomer', 'Homepage::updateCustomer');
$routes->post('updatelapangan', 'Homepage::updateLapangan');
$routes->post('updateadmin', 'Homepage::updateAdmin');

$routes->get('penyewaan/(:alphanum)/(:alphanum)', 'Penyewaan::index/$1/$2');
$routes->get('/penyewaan/save', 'Penyewaan::save');
$routes->get('/editprofile/(:alphanum)', 'Homepage::editprofile/$1',['filter' => 'auth']);
$routes->post('/saveprofile', 'Homepage::saveProfile');
$routes->get('/changepassword/(:alphanum)', 'Homepage::changePassword/$1',['filter' => 'auth']);
$routes->post('/savepassword', 'Homepage::savePassword');


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
