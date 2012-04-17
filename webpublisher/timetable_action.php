<?php
include('db_conn.php');
include('fn.php');

$row = mysql_real_escape_string($_POST['row']);
$col = mysql_real_escape_string($_POST['col']);
$parent = mysql_real_escape_string($_POST['parent']);

switch ($_POST['action']) {

	case 'delete':
		$sql = 'DELETE FROM wp_timetable_event WHERE col = ' . $col . ' AND row = ' . $row . ' AND parent = ' . $parent;
		dbq($sql);
		break;
	case 'update':
		if(isset($_POST['programs']) && count($_POST['programs']) > 0) {
			$program = array();
			foreach($_POST['programs'] as $p) {
				$program[] = mysql_real_escape_string($p);
			}
			$programs = implode('|', $program);
		} else {
			$programs = '';
		}
		$sql = 'UPDATE wp_timetable_event SET ' .
			'title = "' . mysql_real_escape_string($_POST['title']) . '",' . 
			'time = "' . mysql_real_escape_string($_POST['time']) . '",' . 
			'extra = "' . mysql_real_escape_string($_POST['extra']) . '",' . 
			'bgcolour = "' . mysql_real_escape_string($_POST['bgcolour']) . '",' . 
			'colour = "' . mysql_real_escape_string($_POST['colour']) . '",' . 
			'programs = "' . mysql_real_escape_string($programs) . '" ' .
			'WHERE ' . 
			'row = ' . $row . ' ' .
			'AND col = ' . $col . ' ' .
			'AND parent = ' . $parent;
		dbq($sql);
		break;

}

$row = dbq('SELECT * FROM wp_timetable_event WHERE row = ' . $row . ' AND col = ' . $col);

$row = array_shift($row);
$row['title'] = stripslashes($title);
$row['time'] = stripslashes($time);
$row['extra'] = stripslashes($extra);

if(isset($programs) && !empty($programs)) {
	$program_ids = str_replace('|', ',', $programs);
	$row['program_data'] = dbq('SELECT * FROM wp_structure WHERE id IN (' . $program_ids . ')');
} else {
	$row['program_data'] = array();
}

echo json_encode($row);
