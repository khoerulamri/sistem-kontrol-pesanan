<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'C_login';
$route['404_override'] = 'errors/page_missing';
$route['translate_uri_dashes'] = FALSE;


$route['login'] = 'C_login/login';
$route['logout'] = 'C_login/logout';
$route['index'] = 'C_login/index';
$route['changepassword'] = 'C_login/changePassword';
$route['savepassword'] = 'C_login/changePasswordSimpan';

$route['dashboard'] = 'C_index';
$route['dashboard/(:any)'] = 'C_index/$1';
$route['dashboard/(:any)/(:any)'] = 'C_index/$1/$2';
$route['dashboard/(:any)/(:any)/(:any)'] = 'C_index/$1/$2/$3';

$route['instansi'] = 'C_instansi/index';
$route['instansi/(:any)'] = 'C_instansi/$1';

$route['warna'] = 'C_warna/index';
$route['warna/(:any)'] = 'C_warna/$1';

$route['customer'] = 'C_customer/index';
$route['customer/(:any)'] = 'C_customer/$1';
$route['customer/(:any)/(:any)'] = 'C_customer/$1/$2';

$route['pj'] = 'C_pj/index';
$route['pj/(:any)'] = 'C_pj/$1';
$route['pj/(:any)/(:any)'] = 'C_pj/$1/$2';

$route['rekening'] = 'C_rekening/index';
$route['rekening/(:any)'] = 'C_rekening/$1';
$route['rekening/(:any)/(:any)'] = 'C_rekening/$1/$2';

$route['pemesanan'] = 'C_pemesanan/index';
$route['pemesanan/(:any)'] = 'C_pemesanan/$1';
$route['pemesanan/(:any)/(:any)'] = 'C_pemesanan/$1/$2';

$route['pembayaran'] = 'C_pembayaran/index';
$route['pembayaran/(:any)'] = 'C_pembayaran/$1';
$route['pembayaran/(:any)/(:any)'] = 'C_pembayaran/$1/$2';

$route['laporan'] = 'C_laporan/index';
$route['laporan/(:any)'] = 'C_laporan/$1';
$route['laporan/(:any)/(:any)'] = 'C_laporan/$1/$2';
