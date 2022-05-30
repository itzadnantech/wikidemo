<?php
defined('BASEPATH') or exit('No direct script access allowed');

///Dashboard Contorller
$route['dashboard'] = "Dashboard";
$route['logout'] = 'Dashboard/Logout';


///Post Data
$route['post-article'] = 'Wikimedia';
$route['articles-list'] = 'Wikimedia/ArticlesList';



///Articles Controllers
// $route['articles']='Articles';
// $route['articles/add-article']='Articles/AddNewArticles';
// $route['articles/update-article']='Articles/UpdateArticles';
// $route['GetArticlesTableRecordById']='Articles/GetArticlesTableRecordById';


///Partial Controller 
// $route['forgot-password']='Partial/ForgotPassword';
// $route['delete/(:any)/(:any)/(:num)']='Partial/DeleteRecord';





///Others + Login
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
