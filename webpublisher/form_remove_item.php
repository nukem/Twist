<?php

require ("cfg.php");
require ("fn.php");

if (! @ mysql_connect ($cfg['db']['address'], $cfg['db']['username'], $cfg['db']['password']))
 $errors [] = $lang[78];
if (! @ mysql_select_db ($cfg['db']['name']))
 $errors [] = $lang[79];

$id = $_POST['id'];
if(!is_numeric($id)) {
	exit('no id passed to script');
}

$sql = 'DELETE FROM wp_form_element WHERE id = ' . $id;
dbq($sql);

$json['outcome'] = 'success';

echo json_encode($json);
