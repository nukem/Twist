<?php


$address = trim(
	$_POST['address'] . ', ' . $_POST['suburb'] . ', ' . $_POST['state'],
	' ,'
);

if(
	empty($_POST['lat'])
	|| empty($_POST['lon'])
) {
	$coords = retrieve_coords($address);
} else {
	$coords['lat'] = $_POST['lat'];
	$coords['lon'] = $_POST['lon'];
}

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

	$hq = 0;
	if(isset($_POST['hq']) && $_POST['hq'] == 1) {
		$hq = 1;
	}

	$header = 0;
	if(isset($_POST['header']) && $_POST['header'] == 1) {
		$header = 1;
	}

	if ($record['position'] != $_POST['position'])
		dbq ("UPDATE {$cfg['db']['prefix']}_structure SET position = position + 1 WHERE position >= {$_POST['position']} ORDER BY position DESC");
	dbq ("UPDATE
	{$cfg['db']['prefix']}_structure,
	{$cfg['db']['prefix']}_location
	SET
	title = '" . addslashes ($_POST['title']) . "',
		uri = '$uri',
		online = $online,
		sort = '" . mysql_real_escape_string($_POST['sort']) . "',
		position = " . mysql_real_escape_string($_POST['position']) . ",
		modified = '$time',
		viewRights = '$viewRights',
		createRights = '$createRights',
		editRights = '$editRights',
		deleteRights = '$deleteRights',
		address = '" . mysql_real_escape_string($_POST['address']) . "',
		suburb = '" . mysql_real_escape_string($_POST['suburb']) . "',
		state = '"  .mysql_real_escape_string($_POST['state']) . "',
		postcode = '" . mysql_real_escape_string($_POST['postcode']) . "',
		phone = '" . mysql_real_escape_string($_POST['phone']) . "',
		fax = '" . mysql_real_escape_string($_POST['fax']) . "',
		email = '" . mysql_real_escape_string($_POST['email']) . "',
		content = '" . mysql_real_escape_string($_POST['content']) . "',
		lat = '" . mysql_real_escape_string($coords['lat']) . "',
		lon = '" . mysql_real_escape_string($coords['lon']) . "',
		form = '" . mysql_real_escape_string($_POST['form']) . "',
		additional = '" . mysql_real_escape_string($_POST['additional']) . "',
		hq = '{$hq}',
		header = '{$header}'
		WHERE
		link = id AND
		id = {$id}");
}


