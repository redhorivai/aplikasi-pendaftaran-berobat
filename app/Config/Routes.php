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
$routes->setDefaultMethod('');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function(){
    echo "Eaaaa halaman tidak ditemukan !!!";
});
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('/admin/dashboard', 'Dashboard::index');
$routes->get('/admin/pengguna', 'Pengguna::index');
$routes->get('/admin/biodata', 'Biodata::index');
$routes->get('/admin/kunjungan', 'Kunjungan::index');
$routes->get('/admin/kota', 'Kota::index');
$routes->get('/admin/provinsi', 'Provinsi::index');
$routes->get('/admin/informasi', 'Informasi::index');
$routes->get('/admin/password', 'Akun::password');
$routes->get('/admin/laporan', 'Laporan::index');
$routes->post('Kota/getByProv', 'Kota::getByProv');


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
