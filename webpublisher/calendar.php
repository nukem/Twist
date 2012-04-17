<?php
if (! isset ($errorsChecked)) {
	if (! ereg ('.+', $_POST['title']))
		$errors[] = $lang[103];
	if (dbq ("SELECT * FROM {$cfg['db']['prefix']}_structure WHERE parent = {$record['parent']} AND id <> $id AND title = '" . addslashes ($_POST['title']) . "' AND title <> ''"))
		$errors[] = $lang[104];
	$uri = strtolower (ereg_replace ('[^A-Za-z0-9]+', '-', strip_accents ($_POST['title'])));
	if (! isset ($errors) && dbq ("SELECT * FROM {$cfg['db']['prefix']}_structure WHERE parent = {$record['parent']} AND id <> $id AND uri = '$uri' AND uri <> ''"))
		$errors[] = $lang[105];
	if (! isset ($_POST['online']) && $id == $user['parent'])
		$errors[] = $lang[107];
	$errorsChecked = true;
} else {
	if ($record['position'] != $_POST['position'])
		dbq ("UPDATE {$cfg['db']['prefix']}_structure SET position = position + 1 WHERE position >= {$_POST['position']} ORDER BY position DESC");

	$week_start = '';
	if(!empty($_POST['week_label_start'])) {
		$week_start = date('Y-m-d', strtotime($_POST['week_label_start']));
	}
	$week_end = '';
	if(!empty($_POST['week_label_end'])) {
		$week_end = date('Y-m-d', strtotime($_POST['week_label_end']));
	}
	$dates_start = '';
	if(!empty($_POST['show_dates_start'])) {
		$dates_start = date('Y-m-d', strtotime($_POST['show_dates_start']));
	}
	$dates_end = '';
	if(!empty($_POST['show_dates_end'])) {
		$dates_end = date('Y-m-d', strtotime($_POST['show_dates_end']));
	}
	dbq ("UPDATE
	{$cfg['db']['prefix']}_structure,
	{$cfg['db']['prefix']}_calendar
	SET
	title = '" . addslashes ($_POST['title']) . "',
		uri = '$uri',
		content = '" . mysql_real_escape_string($_POST['content']) . "',
		week_label = '" . mysql_real_escape_string($_POST['week_label']) . "',
		week_label_start = '" . mysql_real_escape_string($week_start) . "',
		week_label_end = '" . mysql_real_escape_string($week_end) . "',
		show_dates_start = '" . mysql_real_escape_string($dates_start) . "',
		show_dates_end = '" . mysql_real_escape_string($dates_end) . "',
		online = $online,
		sort = '{$_POST['sort']}',
		position = {$_POST['position']},
		modified = '$time',
		viewRights = '$viewRights',
		createRights = '$createRights',
		editRights = '$editRights',
		deleteRights = '$deleteRights'
		WHERE
		link = id AND
		id = $id");
}

?>
