<?php

include('cfg.php');
include('fn.php');
mysql_connect ($cfg['db']['address'], $cfg['db']['username'], $cfg['db']['password']);
mysql_select_db ($cfg['db']['name']);

$sql = 'UPDATE blog_comments SET content = "%content%" WHERE recId = %recId%';

$search = array(
	'%content%',
	'%recId%'
);

$replace = array(
	mysql_real_escape_string($_POST['content']),
	mysql_real_escape_string($_POST['blog_comment_id'])
);

$sql = str_replace($search, $replace, $sql);

$result = dbq($sql);

if($result > 0) {
	$json['message'] = 'Blog comment updated.';
	$json['comment'] = $_POST['content'];
	$json['recId'] = $_POST['blog_comment_id'];
}


echo json_encode($json);
