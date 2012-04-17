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

if (isset($_GET['type']) && isset($_GET['id']) && preg_match('/^[0-9]+$/', $_GET['id'])) { 
    
    if ($_GET['type'] == 'fabric') {
        
        if(!dbq("DELETE FROM `wp_model_elament` WHERE `id` = '{$_GET['id']}' LIMIT 1")) {
            echo "ERROR";
        } else {	            
            echo "DELETE SUCCESS";
        }               
    } 
}

?>