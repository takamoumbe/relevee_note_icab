<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$active_group = 'db';
$query_builder = TRUE;

$db['db'] = array(
	'dsn'	=> 'sqlite:./application/config/db/Umbreller.db',
	'hostname' => '',
	'username' => '',
	'password' => '',
	'database' => 'Umbreller',
	'dbdriver' => 'pdo',
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
