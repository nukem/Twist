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
UPDATE
ums_user
SET 
email = "' . $values['email'] . '"
WHERE id = ' . $values['userid'];

mysql_query($sql) or die(mysql_error());


$sql = '
UPDATE
ums_user_details
SET 
title = "' . $values['title'] . '",
first_name = "' . $values['first_name'] . '",
initial = "' . $values['initial'] . '",
last_name = "' . $values['last_name'] . '",
phone = "' . $values['phone'] . '",
mobile = "' . $values['mobile'] . '",
address = "' . $values['address'] . '",
suburb = "' . $values['suburb'] . '",
postcode = "' . $values['postcode'] . '",
state = "' . $values['state'] . '",
country = "' . $values['country'] . '",
company = "' . $values['company'] . '",
subscribe = "' . $values['subscribe'] . '"
WHERE userid = ' . $values['userid'];

mysql_query($sql) or die(mysql_error());

$categories = array();
if(isset($_POST['np_category'])) {
	$categories = $_POST['np_category'];
}

$np_result = save_np_categories($values['userid'], $values['subscribe'], $categories);

if($np_result['success'] === false) {
	$json['message'] = $np_result['message'];
} else {
	$json['message'] = 'User\'s details have been saved';
}


echo json_encode($json);
