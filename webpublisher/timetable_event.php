<?php

require('db_conn.php');
require('fn.php');

$row = mysql_real_escape_string($_GET['row']) - 1;
$col = mysql_real_escape_string($_GET['col']) - 1;
$parent = mysql_real_escape_string($_GET['parent']);

$programs = array();
$event = dbq('SELECT * FROM wp_timetable_event WHERE parent = ' . $parent . ' AND row = ' . $row . ' AND col = ' . $col);
if(isset($event) && !empty($event)) {
	$event = array_shift($event);
	$programs = explode('|', $event['programs']);
} else {
	dbq('INSERT INTO wp_timetable_event (row, col, parent) VALUES (' . $row . ', ' . $col . ', ' . $parent . ')');
}
$db_programs = dbq('SELECT * FROM wp_structure WHERE type="submenu" AND parent IN (1524, 1535)');

?>

<div>

	<form onsubmit="return saveData($(this));" class="timetable-event-details">

		<p>
			<label for="title">Title</label>
			<input type="text" class="textfield width-100pct" name="title" value="<?php echo (isset($event['title'])) ? stripslashes(htmlentities($event['title'])) : ''; ?>" />
		</p>

		<p>
			<label for="time">Time Label</label>
			<input type="text" class="textfield width-100pct" name="time" value="<?php echo (isset($event['time'])) ? stripslashes(htmlentities($event['time'])) : ''; ?>" />
		</p>

		<p>
			<label for="extra">Extra information</label>
			<input type="text" class="textfield width-100pct" name="extra" value="<?php echo (isset($event['extra'])) ? stripslashes(htmlentities($event['extra'])) : ''; ?>" />
		</p>

		<p>
			<label>Programs</label><br />
<?php
foreach($db_programs as $prog) {
?>

			<label class="program-label">
				<input type="checkbox" value="<?php echo $prog['id']; ?>" <?php echo (in_array($prog['id'], $programs)) ? 'checked="checked"' : ''; ?> name="programs[]" />
				<?php echo $prog['title']; ?>
			</label>
<?php
}
?>
		</p>


		<p>
			<label for="bgcolour">Background Colour</label>
			<input type="text" class="textfield width-100pct color" name="bgcolour" value="<?php echo (isset($event['bgcolour'])) ? stripslashes(htmlentities($event['bgcolour'])) : ''; ?>" />
		</p>

		<p>
			<label for="colour">Text Colour</label>
			<input type="text" class="textfield width-100pct color" name="colour" value="<?php echo (isset($event['colour'])) ? stripslashes(htmlentities($event['colour'])) : ''; ?>" />
		</p>

		<p>
			<input name="parent" value="<?php echo $parent; ?>" type="hidden" />
			<input name="row" value="<?php echo $row; ?>" type="hidden" />
			<input name="col" value="<?php echo $col; ?>" type="hidden" />
			<input name="action" value="update" type="hidden" />
			<button type="button" onclick="clear_form_elements($('.timetable-event-details')); return saveData($('.timetable-event-details'));">Delete Event Details</button>
			<button type="submit">Save</button>
		</p>

	</form>
</div>
