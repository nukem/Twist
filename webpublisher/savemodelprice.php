<?php

require ("cfg.php");
require ("fn.php");

if (! @ mysql_connect ($cfg['db']['address'], $cfg['db']['username'], $cfg['db']['password'])) {
    $error = 'DB connect error';
}
if (! @ mysql_select_db ($cfg['db']['name'])) {
    $error = 'DB select error';
}

if (get_magic_quotes_gpc ()) {
    $_POST = array_map ('strip_slashes_deep', $_POST);
    $_GET = array_map ('strip_slashes_deep', $_GET);
}

	$type = $_GET['t'];
	$price = mysql_real_escape_string($_GET['price']);
	$id = $_GET['id'];
	$parent = $_GET['parent'];	
	$type_id = $_GET['type_id'];	

	if (isset($_GET['price']) && isset($_GET['id']) && preg_match('/^[0-9]+$/', $_GET['id'])) {				
		if ($type == 'fabric' || $type == 'nail' || $type == "legs" || $type == "leather") {			
			if (!dbq("UPDATE `wp_model_element` SET `price` = '$price' WHERE `id` = '$id' LIMIT 1")) {
				$msg = 'ERROR';
				$title = 'Database Error';
			} else {
				$msg = 'SUCCESS';
				$title = $price;
			}
		
		}    
	} else if (isset($_GET['price']) && isset($_GET['parent']) && preg_match('/^[0-9]+$/', $_GET['parent'])) {
		if ($type == 'fabric' || $type == 'nail' || $type == "legs" || $type == "leather") {			
			if (!dbq("INSERT INTO `wp_model_element` (parent, type, type_id, price, position, online) VALUES ( '$parent' , '$type' , '$type_id' , '$price' , '1', '0' )")) {
				$msg = 'ERROR';
				$title = 'Database Error';
			} else {
				$msg = 'SUCCESS';
				$title = $price;
			}
		}    
		
		
	} else {
		
		$msg = 'ERROR';
		$title = 'Input Error';
		
	}
echo "titleDetails = {msg: '$msg', title: '$title'};";
?>