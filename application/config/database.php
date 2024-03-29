<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';

if (preg_match('/^(sound.lk)/', $_SERVER['HTTP_HOST'])) {
	$active_group = 'dev1';
}

$active_record = TRUE;

/*$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'soundbooka_user';
$db['default']['password'] = 'password123';
$db['default']['database'] = 'soundbooka';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;*/


$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'twlifestyle_user';
$db['default']['password'] = 'qwerty123#';
$db['default']['database'] = 'twistlifestyle';
/*
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'twistlifestyle';
*/
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


$db['dev1']['hostname'] = 'localhost';
$db['dev1']['username'] = 'root';
$db['dev1']['password'] = 'root';
$db['dev1']['database'] = 'sound';
$db['dev1']['dbdriver'] = 'mysql';
$db['dev1']['dbprefix'] = '';
$db['dev1']['pconnect'] = TRUE;
$db['dev1']['db_debug'] = TRUE;
$db['dev1']['cache_on'] = FALSE;
$db['dev1']['cachedir'] = '';
$db['dev1']['char_set'] = 'utf8';
$db['dev1']['dbcollat'] = 'utf8_general_ci';
$db['dev1']['swap_pre'] = '';
$db['dev1']['autoinit'] = TRUE;
$db['dev1']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */