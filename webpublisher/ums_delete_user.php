<?php
require ("cfg.php");
@ mysql_connect ($cfg['db']['address'], $cfg['db']['username'], $cfg['db']['password']);
@ mysql_select_db ($cfg['db']['name']);
require ("fn.php");

if(!isset($_POST) || count($_POST) < 1) {
	exit();
}

$values = array();
foreach($_POST as $k => $val) {
	$values[$k] = mysql_real_escape_string((string)$val);
}

$sql = '
DELETE FROM
ums_user
WHERE id = ' . $values['userid']
. ' LIMIT 1';

mysql_query($sql) or die(mysql_error());

$sql = '
DELETE FROM
ums_user_details
WHERE userid = ' . $values['userid']
. ' LIMIT 1';

mysql_query($sql) or die(mysql_error());

header('Location:index.php?id=312');


/*
$json['message'] = 'User\'s details have been saved';

echo json_encode($json);

 */
