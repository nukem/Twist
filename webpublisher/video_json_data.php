<?php

$videourl = $_GET['videourl'];


$video_url = $videourl;

if(isset($video_url)) {

	include('inc/AutoEmbed.class.php');
	$embed = new AutoEmbed();
	$embed->parseUrl($videourl);
	$video_id = preg_replace('/[^0-9]+/', '', $videourl);
	$embed->setParam('wmode','transparent');
	$code = $embed->getEmbedCode();
	$json = array();
	$json['image'] = $embed->getImageUrl();
	$json['swfobject'] = $code;


	echo json_encode($json);
}

?>
