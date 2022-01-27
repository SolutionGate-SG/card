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
$route['default_controller'] = 'User';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/*
|-------------------------------------------------------------------------------
| For Demo Purpose (All Login in 1)
|-------------------------------------------------------------------------------
*/
$route['demo-login']            = 'User/demo_login';
/*
|-------------------------------------------------------------------------------
|
|-------------------------------------------------------------------------------
*/
$route['general-settings']              = 'Admin/general_setting';
$route['login']                         = 'User/login';
$route['logout']                        = 'User/logout';
$route['register']                      = 'User/register';
$route['index']                         = 'User/index';
$route['index/(:num)']                  = 'User/index';
$route['dashboard']                    	= 'User/index';
$route['change-password']               = 'User/change_password';
$route['user-view']                     = 'User/user_view';

/*------------Settings------------------------------------*/
$route['add_office']                    = "Settings/add_office";
$route['add_office/(:num)']             = "Settings/add_office";
$route['office']                        = "Settings/view_office";
$route['office/(:num)']                 = "Settings/delete_office";
$route['get_categories/(:num)']         = "Settings/getCategories";

$route['add_state']                     = "Settings/add_state";
$route['add_state/(:num)']              = "Settings/add_state";
$route['state']                         = "Settings/view_state";
$route['state/(:num)']                  = "Settings/delete_state";
$route['get_state/(:num)']              = "Settings/getState";

$route['add_district']                  = "Settings/add_district";
$route['add_district/(:num)']           = "Settings/add_district";
$route['district']                      = "Settings/view_district";
$route['district/(:num)']               = "Settings/delete_district";
$route['get_district/(:num)']           = "Settings/getDistrict";

$route['add_local']                     = "Settings/add_local";
$route['add_local/(:num)']              = "Settings/add_local";
$route['local']                         = "Settings/view_local";
$route['local/(:num)']                  = "Settings/delete_local";
$route['get_local/(:num)']              = "Settings/getLocal";

$route['add_ward']                      = "Settings/add_ward";
$route['add_ward/(:num)']               = "Settings/add_ward";
$route['ward']                          = "Settings/view_ward";
$route['ward/(:num)']                   = "Settings/delete_ward";
$route['get_ward/(:num)']               = "Settings/getWard";

$route['add_disable_type']                  = "Settings/add_disable_type";
$route['add_disable_type/(:num)']           = "Settings/add_disable_type";
$route['disable-type']                      = "Settings/view_disable_type";
$route['disable-type/(:num)']               = "Settings/delete_disable_type";
$route['get-disable-type/(:num)']           = "Settings/getDisableType";

$route['add-disable-severity']              = "Settings/add_disable_severity";
$route['edit-disable-severity/(:num)']      = "Settings/add_disable_severity";
$route['disable-severity']                  = "Settings/view_disable_severity";
$route['disable-severity/(:num)']           = "Settings/delete_disable_severity";
$route['get-disable-type/(:num)']           = "Settings/getDisableSeverity";

$route['add_session']                 = "Settings/add_session";
$route['add_session/(:num)']          = "Settings/add_session";
$route['session']                     = "Settings/view_session";
$route['session/(:num)']              = "Settings/delete_session";
$route['getSession/(:num)']           = "Settings/getSession";
$route['session/current']             = "Settings/update_current_session";

$route['add-post']                = "Settings/add_post";
$route['add-post/(:num)']         = "Settings/add_post";
$route['post']                    = "Settings/view_post";
$route['getPost/(:num)']          = "Settings/getPost";

$route['add-worker']                = "Settings/add_worker";
$route['add-worker/(:num)']         = "Settings/add_worker";
$route['worker']                    = "Settings/view_worker";
$route['getWorker/(:num)']          = "Settings/getWorker";

$route['add-blood-type']            = "Settings/add_blood_type";
$route['edit-blood-type/(:num)']    = "Settings/add_blood_type";
$route['blood-type']                = "Settings/view_blood_type";
$route['getBloodType/(:num)']       = "Settings/getBloodType";

/*|------------------------------ Auto District and VDC ----------------------------------|*/
$route['get_districts']                     = "Settings/getdistrictHTML";
$route['get_local_body']                    = "Settings/getlocalbodyHTML";
/*|---------------------------------------------------------------------------------------|*/
/*|-------------------------------- Disable Details --------------------------------------|*/
$route['save-disable-detail']             = 'DisableDetails/save_disable_details';
$route['edit-disable-detail/(:num)']      = 'DisableDetails/save_disable_details';
$route['disable-details-list']            = 'DisableDetails/disable_details_list';
$route['disable-details/(:num)']          = 'DisableDetails/disable_detail';
$route['print-disable1']           = 'DisableDetails/disable_detail_print1';
$route['print-disable2']           = 'DisableDetails/disable_detail_print2';
$route['print-preview']                   = 'DisableDetails/print_preview';
$route['convert-to-Excel/(:any)/(:any)']  = 'DisableDetails/convertPageExcel';  
// added routes for pramint selection
$route['save-pramanit-garne']       = "Settings/add_pramanit_garne";
$route['save-pramanit-garne/(:num)']= "Settings/add_pramanit_garne";
$route['pramanit-garne']            = "Settings/view_pramanit_garne";
$route['delete-pramanit-garne/(:num)'] = 'Settings/delete_pramanit_garne';
$route['getPramanitGarne/(:num)']   = "Settings/getPramanitGarne";
