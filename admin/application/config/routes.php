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
//$route['default_controller'] = 'viewer';
$route['default_controller'] = 'Viewer';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* ---------------- CMS routing ---------------- */
//view/page back end
$route['admin'] = 'Viewer/index'; // show default page
$route['view'] = 'Viewer/pathGuide'; // show default page
$route['view/(:any)'] = 'Viewer/pathGuide/$1'; // show specific page
$route['view/(:any)/(:any)'] = 'Viewer/pathGuide/$1/$2'; // show specific page with param
$route['view/(:any)/(:any)/(:any)'] = 'Viewer/pathGuide/$1/$2/$3'; // show specific page with param
//$route['registrasi'] = 'Viewer/registrasi'; // show default page
//login-logout
$route['login'] = 'Manager/identify/acknowledge'; // login
$route['logout'] = 'Manager/identify/revoke'; // logout
//manage/retieve data
$route['manage'] = 'Manager/process'; // create, update, or delete
$route['object'] = 'Retriever/record'; // read/retrieve data
$route['object/(:any)'] = 'Retriever/record/$1';
$route['objects/(:any)'] = 'Retriever/records/$1'; // read/retrieve list
$route['objects/(:any)/(:any)/(:any)'] = 'Retriever/records/$1/$2/$3/no'; // read/retrieve list with param
$route['pick/(:any)'] = 'Retriever/records/$1/null/null/yes'; // read/retrieve list with param for picker
$route['pick/(:any)/(:any)/(:any)'] = 'Retriever/records/$1/$2/$3/yes'; // read/retrieve list with param for picker

/* untuk aktivasi */
$route['send_verification/(:num)'] = 'Manager/send_verification/$1'; //kirim email link aktivasi
$route['verification/(:num)/(:num)'] = 'Manager/process_verification/$1/$2'; //do verification/activation
//untuk akses login
$route['form_login'] = 'Viewer/form_login'; // login

$route['process_approve'] = 'Manager/process_approve'; // untuk proses approved apply
$route['get_data_test'] = 'Manager/getDataForTest/'; // untuk proses approved apply
$route['get_data_test/(:any)'] = 'Manager/getDataForTest/$1'; // untuk proses approved apply
$route['get_data_interview'] = 'Manager/getDataForInterview'; // untuk proses approved apply
$route['save_test'] = 'Manager/save_test'; // untuk proses approved apply
$route['save_interview'] = 'Manager/save_interview'; // untuk proses approved apply

/*Soal*/
$route['get_soal'] = 'Manager/get_soal'; // untuk proses approved apply

/*Apply*/
$route['apply_loker'] = 'Manager/apply_loker'; // untuk proses approved apply
$route['apply_loker/(:any)'] = 'Manager/apply_loker/$1'; // untuk proses approved apply

/*notif*/
$route['read_notif/(:any)'] = 'Manager/read_notif/$1'; // untuk proses approved apply
$route['start_clock'] = 'Manager/start_clock'; // untuk proses approved apply
$route['get_print_test'] = 'Manager/get_print_test'; // untuk proses approved apply
$route['save_jawaban'] = 'Manager/save_jawaban'; // untuk proses approved apply

/**/
$route['upd_interview'] = 'Manager/upd_interview'; // untuk proses approved apply
$route['cancel_interview'] = 'Manager/cancel_interview'; // untuk proses approved apply


/* Seed data to database */

$route['seed_employee/(:num)'] = 'Data/seed_employee/$1'; // untuk proses approved apply
$route['seed_siswa/(:num)'] = 'Data/seed_siswa/$1'; // untuk proses approved apply
$route['seed_guru/(:num)'] = 'Data/seed_guru/$1'; // untuk proses approved apply
$route['seed_wali_murid/(:num)'] = 'Data/seed_wali_murid/$1'; // untuk proses approved apply


/* manage */
$route['get_jadwal_today'] = 'Manager/get_jadwal_today'; // 
$route['get_siswa_absensi'] = 'Manager/get_siswa_absensi'; // 
$route['save_absen'] = 'Manager/save_absen'; // 
$route['get_realtime'] = 'Manager/get_absen_realtime'; // 
$route['get_siswa'] = 'Manager/getSiswa'; // 
$route['get_all_weeks'] = 'Manager/getAllWeek'; // 
$route['get_all_month'] = 'Manager/getAllMonth'; // 
$route['get_all_semester'] = 'Manager/getAllSemester'; // 
$route['get_mapel'] = 'Manager/getMapel'; // 


$route['print_weekly'] = 'Manager/printReportWeekly'; // 
$route['print_monthly'] = 'Manager/printReportMonthly'; // 
$route['print_semester'] = 'Manager/printReportSemester'; // 



/* API */
$route['api/login'] = 'Api/login';
$route['api/absen-guru'] = 'Api/absenGuru';


/* Public */
$route['absensi-guru-hari-ini'] = 'Publik/absensiGuruHariIni';



