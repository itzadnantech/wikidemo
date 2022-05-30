<?php
defined('BASEPATH') or exit('No direct script access allowed');
$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',

	///live
	// 'hostname' => 'localhost',
	// 'username' => 'ujg7wfgph93a3',
	// 'password' => 'O`41@iC#L7-q',
	// 'database' => 'dbrsqhctsrb5hh',

	//local
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'wikidemo_db',


	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
