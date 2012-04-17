<?
require ("cfg.php");
@ mysql_connect ($cfg['db']['address'], $cfg['db']['username'], $cfg['db']['password']);
@ mysql_select_db ($cfg['db']['name']);
require ("fn.php");

$sql = 'SELECT * FROM np_customers';

$customers = dbq($sql);
$i = 0;
echo '<pre>';
foreach($customers as $c) {
	$sql = 'INSERT INTO np_customer_category (custid_fk, categoryid_fk) VALUES (' . $c['custid'] . ', 1)';
	dbq($sql);
	echo $sql . "\n\n";
}
