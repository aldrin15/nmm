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

$route['default_controller'] 	= "nmm";
$route['rides'] 				= "lift/index";
$route['rides/create'] 			= "lift/create";
$route['rides/detail/(:any)'] 	= "lift/detail/5";
$route['rides/index'] 			= "lift/index/";
$route['rides/index/(:any)'] 	= "lift/index/5";
$route['rides/create-success'] 	= "lift/create_success";
$route['rides-wish-lift']		= "offer_wish_lift";

$route['members/billing-information'] 		= "members/billing_information";
$route['members/ride-detail'] 				= "members/overview_ride_detail";
$route['members/ride-detail/(:num)'] 		= "members/overview_ride_detail/$1";
$route['members/ride-detail/(:num)/(:any)'] = "members/overview_ride_detail/$1/$2";

$route['members/ride-edit'] 				= "members/overview_ride_edit";
$route['members/ride-edit/(:num)'] 			= "members/overview_ride_edit/$1";
$route['members/ride-edit/(:num)/(:any)'] 	= "members/overview_ride_edit/$1/$2";

$route['members/passenger-detail'] 				= "members/overview_passenger_detail";
$route['members/passenger-detail/(:num)'] 		= "members/overview_passenger_detail/$1";
$route['members/passenger-detail/(:num)/(:any)'] = "members/overview_passenger_detail/$1/$2";

$route['contact-us']			= "contact";
$route['contact-us/successful']	= "contact/successfully";
$route['privacy-policy']		= "privacy";
$route['about-us']				= "about";
$route['thank-you']				= "register/thank_you";
$route['payment-error']			= "register/payment_error";
$route['payment-postback']		= "register/payment_postback";
$route['terms-and-condition']	= "terms";
$route['404_override'] 			= '';

$route['admin']					= 'admin/login';


/* End of file routes.php */
/* Location: ./application/config/routes.php */