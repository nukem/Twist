<?php
error_reporting(E_ALL);
//define('BASEPATH', '../');

$cfg['website_url'] = 'http://'.$_SERVER['HTTP_HOST'].'/';
$cfg['db']['address'] = "localhost";
$cfg['db']['username'] = "twlifestyle_user";

$cfg['db']['password'] = "qwerty123#";

$cfg['db']['name'] = "twistlifestyle";
$cfg['db']['prefix']   = "wp";

$cfg['blog']['id'] = 311;

$cfg['base_url'] = 'http://www.realtools.com.au/';
$cfg['wysiwyg_base_uri'] = "../";

$cfg['data'] = "../wpdata/";

$cfg['ums_id'] = 312;

$mce_type[] = 'article';
$mce_type[] = 'video';
$mce_type[] = 'location';
$mce_type[] = 'profile';
$mce_type[] = 'product';
$mce_type[] = 'blog';
$mce_type[] = 'calendar';
$mce_type[] = 'timetable';
$mce_type[] = 'category';
$mce_type[] = 'size';
$mce_type[] = 'leather';
$mce_type[] = 'legs';
$mce_type[] = 'fabric';
$mce_type[] = 'nail';
$mce_type[] = 'model';

$cfg['img']['small']    = array(
	150, 150,
	'crop',
	true,
	100,
	0xFF, 0xFF, 0xFF
);
$cfg['img']['carousel'] = array(
	147, 129,
	'shrink',
	true,
	100,
	0xFF, 0xFF, 0xFF
);
$cfg['img']['medium']   = array(
	314, 314,
	'shrink',
	true,
	100,
	0xFF, 0xFF, 0xFF
);
$cfg['img']['large']    = array(
	1000, 900,
	'shrink',
	false,
	100,
	0xFF, 0xFF, 0xFF
);
$cfg['img']['xl']    = array(
	940, 940,
	'shrink',
	false,
	100,
	0xFF, 0xFF, 0xFF
);


if(preg_match('/^(localhost|192\.168\.)/', $_SERVER['HTTP_HOST'])){
	$cfg['db']['address'] = "localhost";
	$cfg['db']['username'] = "root";
	$cfg['db']['password'] = "";
}
?>
