<?php
defined('BASEPATH') OR exit('No direct script access allowed');

///Dashboard Contorller
$route['dashboard']="Dashboard";
$route['logout']='Dashboard/Logout';


///Users Controllers
$route['users']='Users';
$route['users/add-user']='Users/AddNewUser';
$route['users/update-user']='Users/UpdateUser';
$route['GetUsersTableRecordById']='Users/GetUsersTableRecordById';


///Providers Controllers
$route['providers']='Providers';
$route['providers/add-provider']='Providers/AddNewProvider';
$route['providers/update-provider']='Providers/UpdateProvider';
$route['GetProvidersTableRecordById']='Providers/GetProvidersTableRecordById';


///Articles Controllers
$route['articles']='Articles';
$route['articles/add-article']='Articles/AddNewArticles';
$route['articles/update-article']='Articles/UpdateArticles';
$route['GetArticlesTableRecordById']='Articles/GetArticlesTableRecordById';


///Partial Controller 
$route['forgot-password']='Partial/ForgotPassword';
$route['delete/(:any)/(:any)/(:num)']='Partial/DeleteRecord';
 
 



///Others + Login
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
