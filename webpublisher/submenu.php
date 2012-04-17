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
	if ($record['position'] != $_POST['position']) {
		dbq ("UPDATE {$cfg['db']['prefix']}_structure SET position = position + 1 WHERE position >= {$_POST['position']} ORDER BY position DESC");
	}
	$page_title = '';
	if(isset($_POST['page_title'])){
		$page_title = "page_title = '" . addslashes ($_POST['page_title']) . "', meta_words = '" . addslashes ($_POST['meta_words']) . "', meta_description = '" . addslashes ($_POST['meta_description']) . "',";
	}

	foreach($_POST as $k => $v) {
		if(!is_array($_POST[$k])) {
			$_POST[$k] = mysql_real_escape_string($v);
		}
	}

	dbq ("UPDATE
		{$cfg['db']['prefix']}_structure,
		{$cfg['db']['prefix']}_submenu
		SET
		title = '" . ($_POST['title']) . "',
		uri = '$uri',
		{$page_title}
		url = '{$_POST['url']}',
		page_type = '{$_POST['page_type']}',
		online = $online,
		sort = '{$_POST['sort']}',
		position = {$_POST['position']},
		layout = '{$_POST['layout']}',
		timetable = '{$_POST['timetable']}',
		form = '{$_POST['form']}',
		rgform = '{$_POST['rgform']}',
		gallery = '{$_POST['gallery']}',
		video = '{$_POST['video']}',
		shop_category = '{$_POST['shop_category']}',
		shop_item = '{$_POST['shop_item']}',
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

