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
np_categories
SET category_name = "' . $values['category_name'] . '"
WHERE categoryid = ' . $values['category_id'] . ';';
echo $sql;

mysql_query($sql) or die(mysql_error());

$catid = $values['category_id'];

$json['message'] = 'New category has been added.';
$json['id'] = mysql_insert_id(); 

header('Location: index.php?id=312&mode=np_category_details&catid=' . $catid);
