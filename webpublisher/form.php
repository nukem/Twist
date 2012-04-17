<?php

if (! isset ($errorsChecked)) {
	if (! ereg ('.+', $_POST['title']))
		$errors[] = $lang[103];
	if (dbq ("SELECT * FROM {$cfg['db']['prefix']}_structure WHERE parent = {$record['parent']} AND id <> $id AND title = '" . addslashes ($_POST['title']) . "' AND title <> ''"))
		$errors[] = $lang[104];
	$uri = strtolower (ereg_replace ('[^A-Za-z0-9]+', '-', strip_accents ($_POST['title'])));
	if (! isset ($errors) && dbq ("SELECT * FROM {$cfg['db']['prefix']}_structure WHERE parent = {$record['parent']} AND id <> $id AND uri = '$uri' AND uri <> ''"))
		$errors[] = $lang[105];
	$errorsChecked = true;
} else {


	if ($record['position'] != $_POST['position'])
		dbq ("UPDATE {$cfg['db']['prefix']}_structure SET position = position + 1 WHERE position >= {$_POST['position']} ORDER BY position DESC");


	$add_lead = 0;
	if(isset($_POST['add_lead']) && $_POST['add_lead'] == 1) {
		$add_lead = 1;
	}

	$store_db = 0;
	if(isset($_POST['store_db']) && $_POST['store_db'] == 1) {
		$store_db = 1;
	}

	dbq ("UPDATE
	{$cfg['db']['prefix']}_structure,
	{$cfg['db']['prefix']}_form
	SET
	title = '" . addslashes ($_POST['title']) . "',
		uri = '$uri',
		online = $online,
		sort = '{$_POST['sort']}',
		position = {$_POST['position']},
		modified = '$time',
		viewRights = '$viewRights',
		createRights = '$createRights',
		editRights = '$editRights',
		deleteRights = '$deleteRights',
		email = '{$_POST['email']}',
		store_db = '{$store_db}',
		add_lead = '{$add_lead}'
		WHERE
		link = id AND
		id = $id");
}

?>
