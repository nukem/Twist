<?php

require ("cfg.php");
require ("fn.php");
if (! @ mysql_connect ($cfg['db']['address'], $cfg['db']['username'], $cfg['db']['password']))
 $errors [] = $lang[78];
if (! @ mysql_select_db ($cfg['db']['name']))
 $errors [] = $lang[79];

	// UPDATE
foreach($_POST as $id => $position) {
	$id = mysql_real_escape_string($id);
	$position = mysql_real_escape_string($position);
	$sql = <<<SQL
		UPDATE wp_form_element
		SET
		`position` = {$position}
		WHERE
		id = {$id};
SQL;
	dbq($sql);
}

$json['outcome'] = 'success';

echo json_encode($json);

