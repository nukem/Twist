<?php
error_reporting(E_ALL);
// There are 3 basic functionalities that are needed here:
//
// 1. List users.
// 2. Search Users
// 3. Edit Users
if(!isset($_GET['mode'])) {
	$mode = 'list';
} else {
	$mode = $_GET['mode'];
}
/*
$allowed_modes = array('list', 'details', 'add');
 */
//echo(getcwd() . '/tpl/ums_' . $mode . '.php');
if(is_file(getcwd() . '/tpl/ums_' . $mode . '.php')) {
	include(getcwd() . '/tpl/ums_' . $mode . '.php');
} else {
	exit('Functionality doesn\'t exist');
}
