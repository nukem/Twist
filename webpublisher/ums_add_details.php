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
INSERT INTO
ums_user
(email) VALUES ("' . $values['email'] . '")';

mysql_query($sql) or die(mysql_error());

$userid = mysql_insert_id();

$sql = '
INSERT INTO
ums_user_details
(
	userid,
	title,
	first_name,
	initial,
	last_name,
	phone,
	mobile,
	address,
	suburb,
	postcode,
	state,
	country,
	company,
	subscribe
)
VALUES
(
	"' . $userid . '",
	"' . $values['title'] . '",
	"' . $values['first_name'] . '",
	"' . $values['initial'] . '",
	"' . $values['last_name'] . '",
	"' . $values['phone'] . '",
	"' . $values['mobile'] . '",
	"' . $values['address'] . '",
	"' . $values['suburb'] . '",
	"' . $values['postcode'] . '",
	"' . $values['state'] . '",
	"' . $values['country'] . '",
	"' . $values['company'] . '",
	"' . $values['subscribe'] . '"
)';

mysql_query($sql) or die(mysql_error());

#$userid = mysql_insert_id();

$np_result = save_np_categories($userid, $values['subscribe'], $_POST['np_category']);

$categories = array();
if(isset($_POST['np_category'])) {
	$categories = $_POST['np_category'];
}

$np_result = save_np_categories($userid, $values['subscribe'], $categories);

if($np_result['success'] === false) {
	$json['message'] = $np_result['message'];
} else {
	$json['message'] = 'User\'s details have been saved';
}
$json['id'] = $userid; 

header('Location: index.php?id=312&mode=details&userid=' . $userid);
