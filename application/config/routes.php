<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['admin']        = 'admin/dashboard';
$route['admin/login']  = 'admin/auth/login';
$route['admin/logout'] = 'admin/auth/logout';
$route['admin/signup'] = 'admin/auth/signup';
$route['admin/home']   = 'admin/home';


$route['default_controller'] = 'Home/index';
$route['home'] = 'Home/index';
$route['contact'] = 'Contact/index';
$route['shop'] = 'Shop/index';
$route['cart'] = 'Cart/index';
$route['checkout'] = 'Checkout/index';

$route['profile'] = 'Profile/index';
$route['profile/order/details/(:any)'] = 'Profile/order_details/$1';
$route['profile/order/billing-address'] = 'Profile/edit_billing_address';
$route['profile/order/shipping-address'] = 'profile/edit_shipping_address';
$route['profile/order/billing-address/(:any)'] = 'Profile/edit_billing_address/$1';

$route['payment/get_intent'] = 'Payment/get_intent';
$route['payment/(:any)'] = 'Payment/index/$1';
$route['payment/checking/(:any)'] = 'Payment/check/$1';

$route['thankyou/verify-payment'] = 'Thank_you/verifyIntent';
$route['thankyou/already-paid/(:any)'] = 'Thank_you/already_paid/$1';
$route['thankyou/(:any)'] = 'Thank_you/index/$1';

$route['pdf/(:any)'] = 'pdf/index/$1';

$route['category/(:any)/product/(:any)'] = 'Product/index/$2/$1';


$route['signup'] = 'Auth/signup';
$route['signup-user'] = 'Auth/addUser';
$route['login'] = 'Auth/login';
$route['login-user'] = 'Auth/loginUser';
$route['logout'] = 'Auth/logout';

$route['admin'] = 'admin/Home';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
