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

if(!isset($values['name']) || empty($values['name'])) {
	$json['message'] = 'Please enter your name before continuing.';
	$json['success'] = false;
}

if(!isset($values['contents']) || empty($values['contents'])) {
	$json['message'] = 'Please add some details to the log.';
	$json['success'] = false;
}

if(!isset($json['success']) || $json['success'] !== false ) {
	$sql = '
	INSERT INTO ums_log
	(userid, name, contents)
	VALUES ("' . $values['userid'] . '", "' . $values['name'] . '", "' . $values['contents'] . '");';

	mysql_query($sql) or die(mysql_error());

	$json['message'] = 'Log has been saved';
	$json['success'] = true;
}

echo json_encode($json);

