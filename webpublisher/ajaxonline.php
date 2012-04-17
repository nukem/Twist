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

if (isset($_GET['type']) && preg_match('/^(file|image)$/', $_GET['type']) && isset($_GET['online']) && isset($_GET['id']) && preg_match('/^[0-9]+$/', $_GET['id'])) {
    
    $type = $_GET['type'];
    $id = $_GET['id'];
    $online = $_GET['online'];
    
    dbq("UPDATE `wp_{$type}_gallery` SET `online` = '{$online}' WHERE `id` = '{$id}' LIMIT 1");

}
else if (isset ($_GET['type']))
{
	$type = $_GET['type'];
    $id = $_GET['id'];
    $online = $_GET['online'];
	
	if ($type == "fabric" || $type == "nail" || $type == "legs" || $type == "leather")
	{		
		dbq("UPDATE `wp_model_element` SET `online` = '{$online}' WHERE `type` = '{$type}' AND  `id` = '{$id}' LIMIT 1");
	}
}
?>