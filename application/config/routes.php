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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['auth'] = 'auth';
$route['auth/login'] = 'auth/login';
$route['logout'] = 'auth/logout';

$route['admin/dashboard'] =
'admin/dashboard';
$route['admin/jurusan'] =
'admin/jurusan';
$route['admin/kelas'] =
'admin/kelas';
$route['admin/mapel'] =
'admin/mapel';
$route['admin/guru'] =
'admin/guru';
$route['admin/siswa'] =
'admin/siswa';
$route['admin/kriteria'] =
'admin/kriteria';
$route['admin/pengaturan-voting'] =
'admin/pengaturan_voting';
$route['admin/monitoring-voting'] =
'admin/monitoring_voting';

$route['admin/monitoring-voting/reset/(:num)'] =
'admin/monitoring_voting/reset/$1';

$route['admin/monitoring-voting/reset-all'] =
'admin/monitoring_voting/reset_all';
$route['admin/hasil-voting'] =
'admin/hasil_voting';

$route['admin/siswa/import'] =
'admin/siswa/import';

$route['admin/siswa/template'] =
'admin/siswa/template';
$route['admin/guru/import-foto'] =
'admin/guru/import_foto';
$route['admin/hasil-voting/export-pdf'] =
'admin/Hasil_voting/export_pdf';
$route['admin/user']
= 'admin/user/index';

$route['admin/user/store']
= 'admin/user/store';

$route['admin/user/reset-password/(:num)']
= 'admin/user/reset_password/$1';

$route['admin/user/delete/(:num)']
= 'admin/user/delete/$1';
$route['admin/user/update']
= 'admin/user/update';

//siswa
$route['siswa/dashboard'] =
'siswa/dashboard';
$route['siswa/voting'] =
'siswa/voting';

$route['siswa/voting/(:num)'] =
'siswa/voting/detail/$1';

$route['siswa/voting/store'] =
'siswa/voting/store';