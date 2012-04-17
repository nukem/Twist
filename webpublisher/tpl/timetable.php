<? require ("tpl/inc/head.php"); ?>
<?php

$table_contents = array();
for($row = 0; $row < 20; $row++) {
	for($col = 0; $col < 6; $col++) {
		$result = dbq('SELECT * FROM wp_timetable_event WHERE parent = ' . $record['id'] . ' AND row = ' . $row . ' AND col = ' . $col);
		if(isset($result) && !empty($result)) {
			$table_contents[$row][$col] = array_shift($result);
		} else {
			$table_contents[$row][$col] = array();
		}
	}
}

$db_programs = dbq('SELECT * FROM wp_structure WHERE type="submenu" AND parent IN (1524, 1535)');

$programs = array();
foreach($db_programs as $program) {
	$programs[$program['id']] = $program;
}

function row_contents($row, $col) {
	global $table_contents, $programs;
	$default_cell_contents = <<<HTML

		<a href="#" onclick="editTimetableContents($(this)); return false" class="event {{EVENT_PROGRAM}}" style="{{EVENT_BGCOLOUR}} {{EVENT_COLOUR}}">
			<span class="event-title">{{EVENT_TITLE}}</span>
			<span class="event-time">{{EVENT_TIME}}</span>
			<span class="event-extra">{{EVENT_EXTRA}}</span>
			<em>Edit Event</em>
		</a>

HTML;

	$replace = array(
		'',
		'',
		'',
		'',
		'',
		''
	);

	if(isset($table_contents[$row][$col]['programs']) && !empty($table_contents[$row][$col]['programs'])) {
		$program_uris = array();
		$program_ids = explode('|', $table_contents[$row][$col]['programs']);
		if(isset($program_ids) && !empty($program_ids)) {
			foreach($program_ids as $id) {
				$program_uris[] = $programs[$id]['uri'];
			}
			$program_uris = implode(' ', $program_uris);
		}
	} else {
		$program_uris = '';
	}

	if(isset($table_contents[$row]) && isset($table_contents[$row][$col]) && !empty($table_contents[$row][$col])) {
		$bgcolour = '';
		if(isset($table_contents[$row][$col]['bgcolour']) && !empty($table_contents[$row][$col]['bgcolour'])) {
			$bgcolour = 'background: #' . $table_contents[$row][$col]['bgcolour'] . ';';
		}
		$colour = '';
		if(isset($table_contents[$row][$col]['colour']) && !empty($table_contents[$row][$col]['colour'])) {
			$colour = 'color: #' . $table_contents[$row][$col]['colour'] . ';';
		}
		$replace = array(
			//$table_contents[$row][$col]['programs']
			$program_uris,
			stripslashes($table_contents[$row][$col]['title']),
			stripslashes($table_contents[$row][$col]['time']),
			stripslashes($table_contents[$row][$col]['extra']),
			$bgcolour,
			$colour
		);
	}

	$search = array(
		'{{EVENT_PROGRAM}}',
		'{{EVENT_TITLE}}',
		'{{EVENT_TIME}}',
		'{{EVENT_EXTRA}}',
		'{{EVENT_BGCOLOUR}}',
		'{{EVENT_COLOUR}}'
	);

	$content = str_replace($search, $replace, $default_cell_contents);

	return $content;
}

?>
    <link href="css/smoothness/jquery.ui.custom.css" rel="stylesheet" type="text/css" /> 

    <script src="js/jquery.js" type="text/javascript"></script>  
    
    <script src="js/jquery.ui.custom.min.js" type="text/javascript"></script>
    <script src="js/ajax_load.js" type="text/javascript"></script>
	<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" />
	<script type="text/javascript" src="js/colorpicker.js"></script>
<script>

function editTimetableContents (a) {

	var td = a.closest('td');
	var tr = a.closest('tr');

	var col = td.index();
	var row = tr.index();


	var url = 'timetable_event.php?row=' + row + '&col=' + col + '&parent=<?php echo $record['id']; ?>';

	DP_show(url);



	return false;


}

function  saveData(form) {

	var message = $('.message', form);

	if(message.is(':visible')) {
		message.stop().slideUp('fast');
	}
	$.ajax({

		url: 'timetable_action.php',
		type: 'POST',
		data: form.serialize(),
		success: function (data) {
			updateEvent(data.row, data.col, data.title, data.time, data.extra, data.bgcolour, data.colour);
			DP_remove();
		},
		dataType: 'json'
	})


	return false;
	
}

function updateEvent (row, col, title, time, extra, bgcolor, color) {

	var styleAttr = '';
	if(typeof(bgcolor) != 'undefined') {
		styleAttr += 'background: #' + bgcolor + '; ';
	}
	if(typeof(color) != 'undefined') {
		styleAttr += 'color: #' + color + '; ';
	}
	row = parseInt(row, 10) + 1;
	col = parseInt(col, 10) + 1;
	title = unescape(title);
	time = unescape(time);
	extra = unescape(extra);

	var targetCell = $('td:eq(' + col + ')', '.timetable-table tr:eq(' + row + ')');

	targetCell.html('<a href="#" onclick="editTimetableContents($(this)); return false" class="event" style="' + styleAttr + '"><span class="event-title">' + title + '</span><span class="event-time">' + time + '</span><span class="event-extra">' + extra + '</span><em>Edit Event</em></a>');

}

function clear_form_elements(ele) {

    $(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

}

</script>

<body> 
<div id="page"> 
  <? require ("tpl/inc/header.php"); ?> 
  <? require ("tpl/inc/path.php"); ?> 
  <div id="content"> 
    <div id="left-col"> 
      <div id="left-col-border"> 
        <? if (isset ($errors)) require ("tpl/inc/error.php"); ?> 
        <? if (isset ($messages)) require ("tpl/inc/message.php"); ?> 
        <? if (isset ($_SESSION['epClipboard'])) require ("tpl/inc/clipboard.php"); ?> 
        <? require ("tpl/inc/structure.php"); ?> 
      </div> 
    </div> 
    <div id="right-col"> 
      <h2 class="bar green"><span><?= $lang[69] ?></span></h2> 
      <form action=".?id=<?= $id ?>" method="post"> 
        <? require ("tpl/inc/buttons.php"); ?> 
        <div class="right-col-padding1"> 
          <div class="width-99pct"> 
            <table class="rec-table"> 
              <? require ("tpl/inc/record.php"); ?>
<tr> 
                <td colspan="4"> 
				<label><?= $lang[59] ?></label><br />
         <textarea name="content" cols="30" rows="10" class="textfield height-200 tinymce"><? if (isset ($_POST['title'])) echo htmlspecialchars ($_POST['content']); else echo htmlspecialchars (preg_replace('/src="/', 'src="../', $record['content'])); ?></textarea>
                </td> 
              </tr>

			  <tr>
				  <td colspan="4">

					  <table border="0" bordercolor="" class="timetable-table" style="background-color:" width="" cellpadding="0" cellspacing="0">
							<tr>
								<th>Start Time</th>
								<th>Monday</th>
								<th>Tuesday</th>
								<th>Wednesday</th>
								<th>Thursday</th>
								<th>Friday</th>
								<th>Saturday</th>
							</tr>
<?php
$title_i = 1;
for($row = 0; $row < 20; $row++) {
?>
							<tr>
								<td class="label">
									Label<br />
									<input type="text" name="title_<?php echo $title_i; ?>" class="textfield width-100pct" value="<?php echo show_value('title_' . $title_i); ?>" />
								</td>
<?php
	for($col = 0; $col < 6; $col++) {
?>
								<td>
									<?php echo row_contents($row, $col); ?>
								</td>
<?php
	}
?>
							</tr>
							<tr class="bottom-row">
								<td class="label"></td>

<?php
	$row++;
	for($col = 0; $col < 6; $col++) {
?>
								<td>
									<?php echo row_contents($row, $col); ?>
								</td>
<?php
	}
?>
							</tr>
<!--
							<tr class="seperator">
								<td colspan="7"></td>
							</tr>
							-->
<?php
	$title_i++;
}
?>
						</table>
				  </td>
			  </tr>

			  <? require ("tpl/inc/rights.php"); ?> 
		  </table> 
	  </div> 
  </div> 
	  </form> 
  </div> 
  <? require ("tpl/inc/footer.php"); ?> 
  </div> 
</div> 
</body>
</html>
