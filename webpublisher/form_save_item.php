<?php

require ("cfg.php");
require ("fn.php");
if (! @ mysql_connect ($cfg['db']['address'], $cfg['db']['username'], $cfg['db']['password']))
 $errors [] = $lang[78];
if (! @ mysql_select_db ($cfg['db']['name']))
 $errors [] = $lang[79];

$id = $_POST['id'];
if(!empty($id)) {
	// UPDATE

	$sql = <<<SQL
		UPDATE wp_form_element
		SET
		`label` = '{$_POST['label']}',
		`parent` = '{$_POST['parent']}',
		`position` = '{$_POST['position']}',
		`type` = '{$_POST['type']}',
		`values` = '{$_POST['values']}',
		`required` = '{$_POST['required']}',
		`valid_email` = '{$_POST['valid_email']}'
		WHERE
		id = {$id};
SQL;
	dbq($sql);

} else {
	$sql = "INSERT INTO wp_form_element
	(`label`, `parent`, `position`, `type`, `values`, `required`, `valid_email`)
	VALUES (
		'{$_POST['label']}',
		'{$_POST['parent']}',
		'{$_POST['position']}',
		'{$_POST['type']}',
		'{$_POST['values']}',
		'{$_POST['required']}',
		'{$_POST['valid_email']}'
	);";
	$id = dbq($sql);
}

$json['outcome'] = 'success';
$json['id'] = $id;

echo json_encode($json);

