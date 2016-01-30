<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "main";

// <old_301>
$route['tovar_[\s\S]*?([a-f\d]{32})\.html'] = 'redirect/goods/$1';
$route['catalog_([\s\S]*?)\.html']          = 'redirect/category/$1';
$route['ustanovka_([\s\S]*?)\.html']        = 'redirect/services/$1';
$route['(contacty|dostavka)\.html']         = 'redirect/other/$1';
$route['print([\s\S]*?)\.html']             = 'redirect/print_doc/$1';
// </old_301>

$route['admin'] = "admin";
$route['admin/(:any)']      = "admin/$1";
$route['cron/(:any)']       = "cron/$1";
$route['popup/(:any)']      = "popup/$1";
$route['action/(:any)']     = "action/$1";
$route['price/(:any)']      = "price/$1";
$route['parser/(:any)']     = "parser/$1";
$route['ajax/(:any)']       = "ajax/$1";
$route['print_docs/(:any)'] = "print_docs/$1";
$route['savefile/(:any)']   = "savefile/$1";
$route['donor/(:any)']      = "donor/$1";
$route['tmp/(:any)']        = "tmp/tmp/$1";
$route['(:any)']            = "main/$1";
$route['404_override']      = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */