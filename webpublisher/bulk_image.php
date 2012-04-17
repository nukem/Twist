<?php
require ("cfg.php");
require ("fn.php");
echo 'hi';
print_r($_POST);
print_r($_FILES);

error_reporting (E_ALL);

mysql_connect ($cfg['db']['address'], $cfg['db']['username'], $cfg['db']['password']);
mysql_select_db ($cfg['db']['name']);

$parent = $_POST['parent'];
if(empty($parent)) {
	$parent = $_GET['parent'];
}

// Create database entry
$record = array (
	'id' => 0,
	'title' => 'home',
	'parent' => -1,
	'type' => 'home',
	'viewRights' => '(2)',
	'createRights' => '(2)',
	'editRights' => '',
	'deleteRights' => '',
);

$id = $record['id'];

$db = dbq ("SELECT MAX(position) AS position FROM {$cfg['db']['prefix']}_structure");
$position = $db[0]['position'] + 1;
$defaultRights = "(2)(4)";
$time = date ('Y-m-d H:i:s');
$file_name = substr($_FILES['fileId']['name'], 0, -4);
$sql = "INSERT INTO 
		{$cfg['db']['prefix']}_structure
	SET
		title = '{$file_name}',
		parent = $parent,
		type = 'image',
		sort = 'position',
		position = $position,
		created = '$time',
		modified = '$time',
		viewRights = '$defaultRights',
		createRights = '$defaultRights',
		editRights = '$defaultRights',
		deleteRights = '$defaultRights',
		online = 0
";
$id = dbq ($sql);
move_uploaded_file ($_FILES['fileId']['tmp_name'], $cfg['data'] . $id);
dbq ("INSERT INTO {$cfg['db']['prefix']}_image SET link = $id");
if (is_file ($cfg['data'] . $id)) {
	dbq("UPDATE {$cfg['db']['prefix']}_structure SET online = 1 WHERE id = " . $id);

	resize_img (
		$cfg['data'] . $id,
		$cfg['data'] . "$id-s.jpg",
		$cfg['img']['small'][0],
		$cfg['img']['small'][1],
		$cfg['img']['small'][2],
		$cfg['img']['small'][3],
		$cfg['img']['small'][4],
		$cfg['img']['small'][5],
		$cfg['img']['small'][6],
		$cfg['img']['small'][7]
	);

	resize_img (
		$cfg['data'] . $id,
		$cfg['data'] . "$id-m.jpg",
		$cfg['img']['medium'][0],
		$cfg['img']['medium'][1],
		$cfg['img']['medium'][2],
		$cfg['img']['medium'][3],
		$cfg['img']['medium'][4],
		$cfg['img']['medium'][5],
		$cfg['img']['medium'][6],
		$cfg['img']['medium'][7]
	);

	resize_img (
		$cfg['data'] . $id,
		$cfg['data'] . "$id-l.jpg",
		$cfg['img']['large'][0],
		$cfg['img']['large'][1],
		$cfg['img']['large'][2],
		$cfg['img']['large'][3],
		$cfg['img']['large'][4],
		$cfg['img']['large'][5],
		$cfg['img']['large'][6],
		$cfg['img']['large'][7]
	);

	resize_img (
		$cfg['data'] . $id,
		$cfg['data'] . "$id-xl.jpg",
		$cfg['img']['xl'][0],
		$cfg['img']['xl'][1],
		$cfg['img']['xl'][2],
		$cfg['img']['xl'][3],
		$cfg['img']['xl'][4],
		$cfg['img']['xl'][5],
		$cfg['img']['xl'][6],
		$cfg['img']['xl'][7]
	);

	unlink ($cfg['data'] . $id);
}
