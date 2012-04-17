<?php

include('cfg.php');
include('fn.php');
mysql_connect ($cfg['db']['address'], $cfg['db']['username'], $cfg['db']['password']);
mysql_select_db ($cfg['db']['name']);

$sql = 'SELECT * FROM wp_structure WHERE type = "image" AND parent = ' . mysql_real_escape_string($_POST['parentid']);

$result = dbq($sql);

if(!empty($result)) {

	$ids = array();
	foreach($result as $r) {
		$ids[] = $r['id'];
		$id = $r['id'];
		if ($r['type'] == 'image' && is_file ($cfg['data'] . "$id-l.jpg"))
			unlink ($cfg['data'] . "$id-l.jpg");
		if ($r['type'] == 'image' && is_file ($cfg['data'] . "$id-m.jpg"))
			unlink ($cfg['data'] . "$id-m.jpg");
		if ($r['type'] == 'image' && is_file ($cfg['data'] . "$id-s.jpg"))
			unlink ($cfg['data'] . "$id-s.jpg");
	}

	$count = count($ids);
	$ids = implode(',', $ids);
	$structure = dbq('DELETE FROM wp_structure WHERE id IN (' . $ids . ') AND type = "image"');
	$images = dbq('DELETE FROM wp_image WHERE link IN (' . $ids . ')');
	
	$json['message'] = $count . ' images deleted.';
} else {
	$json['message'] = 'No images to be deleted.';
}

echo json_encode($json);
