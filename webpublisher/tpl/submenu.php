<? require ("tpl/inc/head.php"); ?>
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
									<tr>

									<td colspan="2">
										<label for="url">URL. Include "http://" if you wish this to be an external link. If the link is internal, replace <?php echo $cfg['base_url']; ?> with "./"</label><br />
										<input type="text" name="url" id="url" class="textfield width-100pct" value="<? if (isset ($_POST['title'])) echo htmlspecialchars ($_POST['url']); else echo htmlspecialchars ($record['url']); ?>" /></td>
									<td></td>
									<td></td>
								</tr>
									<td colspan="4">
										<label>Page Type</label><br />
<?php
$page_types = array(
	'title' => 'Title Page',
	'article' => 'Article Page(s)',
	'galleries' => 'Photo Album',
	'video' => 'Video Gallery',
	'images' => 'Image Gallery',
	'map' => 'Map Page',
	'profiles' => 'Staff Profiles',
	'timetable' => 'Time Table',
	'programs' => 'Splash Page'
);
foreach($page_types as $val => $label) {
	$selected = '';
	if($val == show_value('page_type')) {
		$selected = ' checked="checked" ';
	}
?>
<label class="layout-item">
	<input type="radio" name="page_type" value="<?php echo $val; ?>" <?php echo $selected; ?> /><?php echo $label; ?><br />
	<img src="images/layouts/<?php echo $val; ?>.jpg" />
</label>

<?php
}
?>
									</td>

								<tr>
									<td colspan="2"><label>Page Title</label><br /> 
										<input type="text" name="page_title" value="<? if (isset ($_POST['page_title'])) echo htmlspecialchars ($_POST['page_title']); else echo htmlspecialchars ($record['page_title']); ?>" maxlength="255" class="textfield width-100pct" /></td> 
									<td colspan="2"><label>Meta Keywords (Separate keywords with a comma)</label><br /> 
										<input type="text" name="meta_words" value="<? if (isset ($_POST['meta_words'])) echo htmlspecialchars ($_POST['meta_words']); else echo htmlspecialchars ($record['meta_words']); ?>" maxlength="255" class="textfield width-100pct" /></td> 
								</tr>
								<tr>
									<td colspan="4"><label>Meta Description</label><br /> 
										<input type="text" name="meta_description" value="<? if (isset ($_POST['meta_description'])) echo htmlspecialchars ($_POST['meta_description']); else echo htmlspecialchars ($record['meta_description']); ?>" maxlength="255" class="textfield width-100pct" /></td>  
								</tr>
								<tr>
									<td colspan="2">
					<?php
					$clubs = dbq('SELECT * FROM wp_structure, wp_submenu WHERE id = link AND online = 1 AND page_type = "galleries"');
					?>
										<label>Include a link to a gallery on this page.</label><br />
										<select name="gallery" class="width-100pct textfield">
											<option></option>
					<?php
					$curr_value = show_value('gallery');
					foreach($clubs as $c) {
						$selected = '';
						if(!empty($curr_value) && ($c['id'] == show_value('gallery'))) {
							$selected = 'selected="selected"';
						}
					?>
											<option value="<?php echo $c['id']; ?>" <?php echo $selected; ?> ><?php echo $c['title']; ?></option>
					<?php
					}
					?>
										</select>
									</td>
									<td colspan="2">
					<?php
					$clubs = dbq('SELECT * FROM wp_structure, wp_video WHERE id = link AND online = 1');
					?>
										<label>Include a link to a video on this page.</label><br />
										<select name="video" class="width-100pct textfield">
											<option></option>
					<?php
					$curr_value = show_value('video');
					foreach($clubs as $c) {
						$selected = '';
						if(!empty($curr_value) && ($c['id'] == show_value('video'))) {
							$selected = 'selected="selected"';
						}
					?>
											<option value="<?php echo $c['id']; ?>" <?php echo $selected; ?> ><?php echo $c['title']; ?></option>
					<?php
					}
					?>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="2">
					<?php
					$clubs = dbq('SELECT * FROM wp_structure, wp_form WHERE id = link AND online = 1');
					?>
										<label>Include a link to a form on this page.</label><br />
										<select name="form" class="width-100pct textfield">
											<option></option>
					<?php
					$curr_value = show_value('form');
					foreach($clubs as $c) {
						$selected = '';
						if(!empty($curr_value) && ($c['id'] == show_value('form'))) {
							$selected = 'selected="selected"';
						}
					?>
											<option value="<?php echo $c['id']; ?>" <?php echo $selected; ?> ><?php echo $c['title']; ?></option>
					<?php
					}
					?>
										</select>
									
									</td>
									<td colspan="2">
					<?php
					$curr_value = show_value('timetable');
					$clubs = dbq('SELECT * FROM wp_structure, wp_submenu WHERE id = link AND online = 1 AND page_type = "timetable"');
					?>
										<label>Include a link to a timetable on this page.</label><br />
										<select name="timetable" class="width-100pct textfield">
											<option></option>
					<?php
					foreach($clubs as $c) {
						$selected = '';
						if(!empty($curr_value) && ($c['id'] == show_value('timetable'))) {
							$selected = 'selected="selected"';
						}
					?>
											<option value="<?php echo $c['id']; ?>" <?php echo $selected; ?> ><?php echo $c['title']; ?></option>
					<?php
					}
					?>
										</select>
									
									</td>
								</tr>
					<tr>
									<td colspan="2">
					<?php
					$clubs = dbq('SELECT * FROM wp_structure, wp_form WHERE id = link AND online = 1');
					?>
										<label>Include a link to a register button to this page.</label><br />
										<select name="rgform" class="width-100pct textfield">
											<option></option>
					<?php
					$curr_value = show_value('rgform');
					foreach($clubs as $c) {
						$selected = '';
						if(!empty($curr_value) && ($c['id'] == show_value('rgform'))) {
							$selected = 'selected="selected"';
						}
					?>
											<option value="<?php echo $c['id']; ?>" <?php echo $selected; ?> ><?php echo $c['title']; ?></option>
					<?php
					}
					?>
										</select>
									
									</td>
									<td colspan="2">
					
									
									</td>
								</tr>


								<tr>
									<td colspan="2">
					<?php
					$clubs = dbq('SELECT * FROM wp_structure, wp_folder WHERE parent = 10 AND id = link AND online = 1');
					?>
										<label>Include a link to a product category on this page.</label><br />
										<select name="shop_category" class="width-100pct textfield">
											<option></option>
					<?php
					$curr_value = show_value('shop_category');
					foreach($clubs as $c) {
						$selected = '';
						if(!empty($curr_value) && ($c['id'] == show_value('shop_category'))) {
							$selected = 'selected="selected"';
						}
					?>
											<option value="<?php echo $c['id']; ?>" <?php echo $selected; ?> ><?php echo $c['title']; ?></option>
					<?php
					}
					?>
										</select>
									
									</td>
									<td colspan="2">
					<?php
					$clubs = dbq('SELECT * FROM wp_structure, wp_product WHERE id = link AND online = 1');
					?>
										<label>Include a link to a product on this page.</label><br />
										<select name="shop_item" class="width-100pct textfield">
											<option></option>
					<?php
					$curr_value = show_value('shop_item');
					foreach($clubs as $c) {
						$selected = '';
						if(!empty($curr_value) && ($c['id'] == show_value('shop_item'))) {
							$selected = 'selected="selected"';
						}
					?>
											<option value="<?php echo $c['id']; ?>" <?php echo $selected; ?> ><?php echo $c['title']; ?></option>
					<?php
					}
					?>
										</select>
									
									</td>
									
								</tr>
								
								<tr>
									<td colspan="4">
										<label>Page Layout (Title and Article Pages)</label><br />
<?php
$layouts[] = array(
	'name' => 'Standard Layout',
	'view' => 'content_view',
	'img' => 'img/layout/content_view.gif'
);

$layouts[] = array(
	'name' => 'Image on Left Layout',
	'view' => 'content2_view',
	'img' => 'img/layout/content2_view.gif'
);

$layouts[] = array(
	'name' => 'Three Columns of text',
	'view' => 'three_column_view',
	'img' => 'img/layout/three_column_view.gif'
);

$layouts[] = array(
	'name' => 'One Column with 2 image columns',
	'view' => 'one_column_view',
	'img' => 'img/layout/one_column_view.gif'
);
$selected = show_value('layout');
foreach($layouts as $l) {
	$checked = '';
	
	if(!empty($selected) && ($selected == $l['view'] || $selected == $l['view'])) {
		$checked = 'checked="checked"';
	}
?>
<label class="layout-item">
	<input type="radio" name="layout" value="<?php echo $l['view']; ?>" <?php echo $checked; ?> /><?php echo $l['name']; ?><br />
	<img src="<?php echo $l['img'] ?>" />
</label>
<?php
}
?>
									</td>
								</tr>

								<tr>
									<td colspan="2">
										<p>Image Gallery Bulk Uploader (Max 25 images per time.)</p>
<?php
$child_folders = dbq('SELECT id, title FROM wp_structure WHERE type="folder" AND parent = ' . $id);
?>
										<p>
											Select folder to upload to
											<select name="image_parent" class="image-parent-id textfield width-100pct">
												<option value="<?php echo $id; ?>">This folder</option>
<?php
foreach($child_folders as $f) {
?>
												<option value="<?php echo $f['id']; ?>">
													<?php echo $f['title']; ?>
												</option>
<?php
}
?>
											</select>
										</p>

										<div class="fieldset flash" id="fsUploadProgress">
											<span class="legend">Upload Queue</span>
										</div>
										<div id="divStatus">0 Files Uploaded</div>
										<div>
											<span id="spanButtonPlaceHolder"></span>
											<input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
										</div>


									</td>

									<td colspan="2">
										<p>Image Gallery Bulk Deleter</p>
<?php
$child_folders = dbq('SELECT id, title FROM wp_structure WHERE type="submenu" AND parent = ' . $id);
?>


										<button onclick="$('.bulk-deleter').show(); $(this).hide(); return false;" style="width: auto;" class="button deleter-btn">Select folder to delete from</button>
										<div class="bulk-deleter" style="display: none;">
										<p>
											Select folder to delete images from<br />
											<span style="color: #f00">NOTE: IMAGES CAN NOT BE UNDELETED</span>
											<select name="image_parent" class="delete-parent-id textfield width-100pct">
												<option value=""></option>
												<option value="<?php echo $id; ?>">This folder</option>
<?php
foreach($child_folders as $f) {
?>
												<option value="<?php echo $f['id']; ?>">
													<?php echo $f['title']; ?>
												</option>
<?php
}
?>
											</select>
										</p>

										<div>
											<button type="submit" class="button" style="width: auto;" onclick="return bulkDeleter($('.delete-parent-id').val(), $('.delete-parent-id option:selected').text());">Delete Images</button>
											<button type="button" class="button" style="width: auto;" onclick="$('.bulk-deleter').hide(); $('.deleter-btn').show();">Cancel (No images will be deleted)</button>
										</div>


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
<script type="text/javascript" src="js/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
		
		<script type="text/javascript">

		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "swf/swfupload.swf",
				upload_url: "bulk_image.php?parent=<?php echo $id; ?>",
				file_post_name : "fileId",
				file_size_limit : "8 MB",
				file_types : "*.*",
				file_types_description : "All Files",
				file_upload_limit : 25,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "images/upload-bg.png",
				button_width: "104",
				button_height: "27",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont"></span>',
				button_text_style: ".theFont {  }",
				
				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
				
			};
			
// This event comes from the Queue Plugin
function queueComplete(numFilesUploaded) {
	var status = document.getElementById("divStatus");
	status.innerHTML = numFilesUploaded + " file" + (numFilesUploaded === 1 ? "" : "s") + " uploaded.";
}

			swfu = new SWFUpload(settings);
	     };

	 </script>		 
	</body>
</html>

