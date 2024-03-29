<? require ("tpl/inc/head.php"); ?>
<?php
function create_select($name, $option_labels, $option_values) {

	$html = '<select id="' . $name . '" name="' . $name .'" class="textfield width-100pct">';

	global $record;

	if(isset($_POST[$name])) {
		$post_val = $_POST[$name];
	} else {
		$post_val = '';
	}

	if(isset($record[$name])) {
		$record_val = $record[$name];
	} else {
		$record_val = '';
	}
	
	$count = count($option_values);

	$html .= '<option></option>';

	for($i = 0; $i < $count; $i++) {
		
		if($option_values[$i] == $post_val || $option_values[$i] == $record_val) {
			$selected = ' selected="selected" ';
		} else {
			$selected = '';
		}
		$html .= '<option value="' . $option_values[$i] . '"' . $selected . '>' . $option_labels[$i] . '</option>';
	}

	$html .= '</select>';

	return $html;
}
?>
<body> 
<script>

function video_data() {
	var videourl = $('#videourl').val();
	$.getJSON('video_json_data.php?videourl=' + videourl, function(json) {
		$('#embed').val(json.swfobject);
	});
}


$(function () {
	$('#update').bind('click', function() {
		video_data();
	});
});
</script>
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
				  	<td colspan="2">
<?php
$data = dbq('SELECT propid, street_address, suburb, external_link FROM prop_details WHERE external_link != \'\' AND (online = 1 OR status = "sold")');

$labels = array();
$values = array();

$count = count($data);
for($i = 0; $i < $count; $i++) {
	$labels[] = $data[$i]['street_address'] . ', ' . $data[$i]['suburb'];
	$values[] = $data[$i]['external_link'];
}
?>								
								<tr>
									<td colspan="2">

										<label>Property</label>
<?php
echo create_select('video', $labels, $values, 'video');
?>
									</td>
					<td colspan="2">
						<label>Video Url (Propvid url)</label><br/> 
						<input type="text" class="textfield width-300" maxlength="255" value="<? if (isset ($_POST['title'])) echo htmlspecialchars ($_POST['videourl']); else echo htmlspecialchars ($record['videourl']); ?>" id="videourl" name="videourl"/>
						<input type="button" class="button" value="Retrieve Details" name="update" id="update"/>
					</td>
<?php
$sql = "SELECT title, id FROM wp_structure WHERE type = 'agent' AND online = 1";
$agents = dbq($sql);

$select = array();
foreach($agents as $a) {
	$select[$a['id']] = $a['title'];
}
?>
				</tr>
				<tr>
					<td colspan="2">
						<label>Agents</label><br/> 
						<select class="textfield width-100pct" name="agent_1">
							<option></option>
<?php
foreach($select as $v => $t) {
?>
<option value="<?php echo $v;?>" <?php if(isset($_POST['agent_1']) && $_POST['agent_1'] == $v || isset($record['agent_1']) && $record['agent_1'] == $v) { echo
'selected="selected"'; } ?>><?php echo $t; ?></option>
<?php
}
?>
						</select>
					</td>
					<td colspan="2">
						<label>&nbsp;</label><br/> 
						<select class="textfield width-100pct" name="agent_2">
							<option></option>
<?php
foreach($select as $v => $t) {
?>
<option value="<?php echo $v;?>" <?php if(isset($_POST['agent_2']) && $_POST['agent_2'] == $v || isset($record['agent_2']) && $record['agent_2'] == $v) { echo
'selected="selected"'; } ?>><?php echo $t; ?></option>
<?php
}
?>
						</select>
					</td>
				</tr>
				<tr>

					<td colspan="2">
						<label>Video Title (eg. Agent name or Property Address)</label>
						<input type="text" class="textfield width-100pct" maxlength="255" value="<? if (isset ($_POST['title'])) echo htmlspecialchars ($_POST['address']); else echo htmlspecialchars ($record['address']); ?>" id="address" name="address"/>
					</td>
					<td colspan="2">
						<label>Suburb</label><br/> 
						<input type="text" class="textfield width-100pct" maxlength="255" value="<? if (isset ($_POST['title'])) echo htmlspecialchars ($_POST['suburb']); else echo htmlspecialchars ($record['suburb']); ?>" id="suburb" name="suburb"/>
					</td>
					
				</tr>

				<tr>
					<td colspan="4">
						<label>Embed Code (Do Not Edit)</label>
						<input type="text" id="embed" name="embed" cols="30" rows="10" class="textfield width-100pct" value="<? if (isset ($_POST['embed'])) echo htmlspecialchars ($_POST['embed']); else echo htmlspecialchars (preg_replace('/src="/', 'src="../', $record['embed'])); ?>" />
					</td>
				</tr>

				<tr>
					<td colspan="4">
						<label>Agent Details</label>
						<textarea id="details" name="details" cols="30" rows="10" class="textfield height-200 width-100pct tinymce"><? if (isset ($_POST['title'])) echo htmlspecialchars ($_POST['details']); else echo htmlspecialchars (preg_replace('/src="/', 'src="../', $record['details'])); ?></textarea>
					</td>
				</tr>
				<tr>
					<td>
<?php
	if($record['featured'] == '1') {
		$featured = 'checked="checked"';
	} else {
		$featured = '';
	}

?>
						<label>
							<input type="checkbox" id="featured" name="featured" value="1" <?php echo $featured; ?> /> 
							Featured Video
						</label>
						
					</td>
					<td>
<?php
	if($record['recent'] == '1') {
		$recent = 'checked="checked"';
	} else {
		$recent = '';
	}
?>

						
						<label>
							<input type="checkbox" id="recent" name="recent" value="1" <?php echo $recent; ?> /> 
							Recent Video
						</label>
					</td>
					<td>
<?php
	if($record['sold'] == '1') {
		$recent = 'checked="checked"';
	} else {
		$recent = '';
	}
?>
						<label>
							<input type="checkbox" id="sold" name="sold" value="1" <?php echo $recent; ?> />
							Sold Property
						</label>
						
					</td>
<?php
	if($record['other'] == '1') {
		$recent = 'checked="checked"';
	} else {
		$recent = '';
	}
?>					<td>
						<label>
							<input type="checkbox" id="other" name="other" value="1" <?php echo $recent; ?> /> 
							Company Video
						</label>
					</td>
				</tr>

				<tr>
					<td>
<?php
	if($record['auction'] == '1') {
		$auction = 'checked="checked"';
	} else {
		$auction = '';
	}

?>
						<label>
							<input type="checkbox" id="auction" name="auction" value="1" <?php echo $auction; ?> /> 
							Auction Video
						</label>
						
					</td>
					<td>
<?php
	if($record['agent'] == '1') {
		$agent = 'checked="checked"';
	} else {
		$agent = '';
	}
?>

						
						<label>
							<input type="checkbox" id="agent" name="agent" value="1" <?php echo $agent; ?> /> 
							Agent Video
						</label>
					</td>
										<td>
<?php
	if($record['suburb_profile'] == '1') {
		$suburb_profile = 'checked="checked"';
	} else {
		$suburb_profile = '';
	}
?>

						
						<label>
							<input type="checkbox" id="agent" name="suburb_profile" value="1" <?php echo $suburb_profile; ?> /> 
							Suburb Profile
						</label>
					</td>
					<td></td>
<?php /* ?>
					<td>
<?php
	if($record['sold'] == '1') {
		$recent = 'checked="checked"';
	} else {
		$recent = '';
	}
?>
						<label>
							<input type="checkbox" id="sold" name="sold" value="1" <?php echo $recent; ?> />
							Sold Property
						</label>
						
					</td>
<?php
	if($record['other'] == '1') {
		$recent = 'checked="checked"';
	} else {
		$recent = '';
	}
?>					<td>
						<label>
							<input type="checkbox" id="other" name="other" value="1" <?php echo $recent; ?> /> 
							Other Video
						</label>
					</td>
<?php //*/ ?>
				</tr>
				
								<td colspan="2">
				  <label>Upload Images</label><br />
				  <input type="file" name="jq-images" id="jq-images" onChange="return ajaxFileUpload('jq-images', 'image-parent');" />
				  
                  <div id="image-parent">
					<ul id="image-sort">
					<?
                    $linked_images = dbq("SELECT * FROM `wp_image_gallery` WHERE `parent` = '{$id}' ORDER BY `position`");
                    if (is_array($linked_images)) {
                      foreach ($linked_images as $li) {
                        ?>
                        <li class="sort-li" id="<?= $li['id'] ?>">
                          <img src="js/handle.gif" alt="move" class="move" />
                          <img src="js/edit.gif" alt="edit" class="edit" onClick="$(this).siblings('.editor').css('display', 'inline'); $(this).siblings('.preview').css('display', 'none'); trapEnter('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'image');" />
                          <span class="editor">
                            <input type="text" id="edit-<?= $li['id'] ?>" value="<?= $li['title'] ?>" />
                            <input type="button" value="save" onClick="saveTitle('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'image');" />
                            <img src="js/loading.gif" alt="loading" class="edit-no-show" />
                            <input type="button" id="edit-cancel-<?= $li['id'] ?>" value="cancel" onClick="$(this).parent().siblings('.preview').css('display', 'inline'); $(this).parent().css('display', 'none'); releaseEnter();" /> or remove this image 
                            <img src="js/unlink.gif" alt="un-link" class="unlink" onClick="if (window.confirm ('Are you sure?')) { deleteFile('image', <?= $li['id'] ?>); $(this).parent().parent().hide('fast'); }" />
                          </span>
                          <a href="#" title="preview" class="preview" onClick="$('img.thumb:visible').slideUp(200); $(this).siblings('img.thumb:not(:visible)').slideDown(200); return false;"><span class="pic-title"><?= $li['title'] ?></span>
                          &nbsp;<img src="js/preview.gif" alt="preview" /></a>
                          <span class="preview">
                            <input type="checkbox" id="online-image-<?= $li['id'] ?>" onChange="updateOnline('image', <?= $li['id'] ?>);"<? if ($li['online'] == 1) echo ' checked="checked"'; ?> />
                            <img src="js/web_<? if ($li['online'] == 1) echo 'online'; else echo 'offline' ?>.gif" class="onoff" alt="online/offline" />
                          </span>
                            <img src="../wpdata/images/<?= $li['id'] ?>-s.jpg" class="thumb" onClick="$(this).slideUp(100); return false;" />
                        </li>
                        <?
                      }
                    }
                    ?>
					</ul>
                  <input type="button" id="image-sort-save" value="save order" onClick="return saveSort('image-sort');" />
                  <img src="js/loading.gif" alt="loading" id="image-sort-no-show" />
				  </div>
				</td>
				<td colspan="2">
				  <label>Upload Files</label><br />
				  <input type="file" id="jq-files" name="jq-files" onChange="return ajaxFileUpload('jq-files', 'file-parent');" />
				  <div id="file-parent">
					<ul id="file-sort">
					<?
                    $linked_files = dbq("SELECT * FROM `wp_file_gallery` WHERE `parent` = '{$id}' ORDER BY `position`");
                    if (is_array($linked_files)) {
                      foreach ($linked_files as $lf) {
                        ?>
                        <li class="sort-li" id="<?= $lf['id'] ?>">
                          <img src="js/handle.gif" alt="move" class="move" />
                          <img src="js/edit.gif" alt="edit" class="edit" onClick="$(this).siblings('.editor').css('display', 'inline'); $(this).siblings('.preview').css('display', 'none'); trapEnter('#edit-<?= $lf['id'] ?>', <?= $lf['id'] ?>, 'file');" />
                          <span class="editor">
                            <input type="text" id="edit-<?= $lf['id'] ?>" value="<?= $lf['title'] ?>" />
                            <input type="button" value="save" onClick="saveTitle('#edit-<?= $lf['id'] ?>', <?= $lf['id'] ?>, 'file');" />
                            <img src="js/loading.gif" alt="loading" class="edit-no-show" />
                            <input type="button" id="edit-cancel-<?= $lf['id'] ?>" value="cancel" onClick="$(this).parent().siblings('.preview').css('display', 'inline'); $(this).parent().css('display', 'none'); releaseEnter();" /> or remove this file 
                            <img src="js/unlink.gif" alt="un-link" class="unlink" onClick="if (window.confirm ('Are you sure?')) { deleteFile('file', <?= $lf['id'] ?>); $(this).parent().parent().hide('fast'); }" />
                          </span>
                          <span class="preview">
                          <?
                          if (is_file ('../wpdata/files/' . $lf['id'] . "." . $lf['extension'])) { ?> 
                  <img src="img/ico-file/<? if (is_file ("img/ico-file/" . $lf['extension'] . ".gif")) echo "{$lf['extension']}.gif"; else echo "unknown.gif"; ?>" alt="Preview" width="16" height="16" /> <a href="file-preview.php?file=files/<?=  $lf['id'] . '.' . $lf['extension'] ?>&amp;filename=<?= $lf['title'] . "." . $lf['extension'] ?>"><?= $lf['title'] ?></a>
                        <? } ?>
                        <input type="checkbox" id="online-file-<?= $lf['id'] ?>" onChange="updateOnline('file', <?= $lf['id'] ?>);"<? if ($lf['online'] == 1) echo ' checked="checked"'; ?> />
                        <img src="js/web_<? if ($lf['online'] == 1) echo 'online'; else echo 'offline' ?>.gif" class="onoff" alt="online/offline" />
                        </span>
                        </li>
                        <?
                      }
                    }
                    ?>
					</ul>
                  <input type="button" id="file-sort-save" value="save order" onClick="return saveSort('file-sort');" />
                  <img src="js/loading.gif" alt="loading" id="file-sort-no-show" />
				  </div>
				</td>
			  </tr>
              <? require ("tpl/inc/rights.php"); ?> 
		    </table> 
    <script type="text/javascript">
	
    var loadImage = new Image();
	loadImage.src = 'js/loading.gif';
    var onlineImage = new Image();
	onlineImage.src = 'js/web_online.gif';
    var offlineImage = new Image();
	offlineImage.src = 'js/web_offline.gif';
    
    $(document).ready(function () {
      $('#image-sort').Sortable({
		accept: 'sort-li',
        handle: 'img.move',
        opacity: 0.2,
        axis: 'vertically',
		onStop: function() {
          $('#image-sort-save:not(:visible)').show('fast', function(){
            $(this).css('display', 'inline');
          });
        }
	  });
      $('#file-sort').Sortable({
		accept: 'sort-li',
        handle: 'img.move',
        opacity: 0.2,
        axis: 'vertically',
		onStop: function() {
          $('#file-sort-save:not(:visible)').show('fast', function(){
            $(this).css('display', 'inline');
          });
        }

	  });
      
    });
    
    function updateOnline(type, id) {
      var isOnline = 1;
      if ($('#online-'+type+'-'+id).attr('checked')) {
        $('#online-'+type+'-'+id).siblings('img.onoff')[0].src = onlineImage.src;
      } else {
        $('#online-'+type+'-'+id).siblings('img.onoff')[0].src = offlineImage.src;
        isOnline = 0;
      }
      $.get(
        'ajaxonline.php?t=' + new Date().getTime(),
        {'type' : type, 'id': id, 'online': isOnline},
        function(data){
        }
      );
    }
    
    function saveSort(type) {
      serial = $.SortSerialize(type);
      $('#'+type+'-no-show').css('display', 'inline');
      $.post('savesortorder.php?'+serial.hash, {}, function(data){
        if (data == "SUCCESS") {  
          $('#'+type+'-no-show').hide('fast');
          $('#'+type+'-save').hide('fast');
        } else {
          alert('ERROR! debug info:\n\n' + data);
        }
      });
      return false;
    }
    
    function trapEnter(id, num, type){
      $(id).focus().select();
      document.onkeyup = function(e){
        if (e == null) { // ie
          keycode = event.keyCode;
        } else { // mozilla
          keycode = e.which;
        }
        if(keycode == 13){ // enter key
          saveTitle(id, num, type);
        }
      }
      return false;
    }
    
    function releaseEnter(){
      document.onkeyup = '';
      return false;
    }
    
    function saveTitle(id, num, type) {
      $(id).siblings('.edit-no-show').css('display', 'inline');
      var titleDetails;
      $.get(
        'saveimagetitle.php?t='+type,
        {'nt' : $(id).val(), 'id': num},
        function(data){
          eval(data);
          if(typeof(titleDetails) == 'object' && titleDetails.msg == 'SUCCESS') {
            $(id).parent().siblings('.preview').children('.pic-title').html(titleDetails.title);
            $(id).parent().siblings('.preview').css('display', 'inline');
            $(id).siblings('.edit-no-show').css('display', 'none');
            $(id).parent().css('display', 'none');
          } else {
            if (titleDetails.title) {
              alert('Update Error!\n'+titleDetails.title);
            } else {
              alert('Update Error!');
            }
          }
        }
      );
      document.onkeyup = '';
      return false;
    }
    
    function deleteFile(type, id) {
      $.get(
        'deleteajaxfiles.php?t=' + new Date().getTime(),
        {'type' : type, 'id': id},
        function(data){
        }
      );
      return false;
    }
    
	function ajaxFileUpload(elemID, parentID)
	{
		var tempID = new Date().getTime();
		$('#'+parentID+' ul').append('<li id="'+tempID+'" class="sort-li"><img src="js/loading.gif"> Upload in progress</li>');
		$('#'+tempID).slideDown(500);

		$.ajaxFileUpload
		(
			{
				url:'doajaxfileupload.php?element='+elemID+'&parent=<?= $id ?>',
				secureuri:false,
				fileElementId:elemID,
				iframeParent:parentID,
				dataType: 'json',
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.msg == 'SUCCESS') {
						  $('#'+tempID+' img').hide(300, function(){
                            var liHTML = '<li class="sort-li" id="' + data.insert_id + '"><img src="js/handle.gif" alt="move" class="move" /><img src="js/edit.gif" alt="edit" class="edit" onclick="$(this).siblings(\'.editor\').css(\'display\', \'inline\'); $(this).siblings(\'.preview\').css(\'display\', \'none\'); trapEnter(\'#edit-' + data.insert_id + '\', ' + data.insert_id + ', \'image\');" /><span class="editor"><input type="text" id="edit-' + data.insert_id + '" value="' + data.image_title + '" /><input type="button" value="save" onclick="saveTitle(\'#edit-' + data.insert_id + '\', ' + data.insert_id + ', \'image\');" /><img src="js/loading.gif" alt="loading" class="edit-no-show" /><input type="button" id="edit-cancel-' + data.insert_id + '" value="cancel" onclick="$(this).parent().siblings(\'.preview\').css(\'display\', \'inline\'); $(this).parent().css(\'display\', \'none\');" /> or remove this image <img src="js/unlink.gif" alt="un-link" class="unlink" onclick="if (window.confirm (\'Are you sure?\')) { deleteFile(\'image\', ' + data.insert_id + '); $(this).parent().parent().hide(\'fast\'); }" /></span><a href="#" title="preview" class="preview" onclick="$(\'img.thumb:visible\').slideUp(200); $(this).siblings(\'img.thumb:not(:visible)\').slideDown(200); return false;"><span class="pic-title">' + data.image_title + '</span>&nbsp;<img src="js/preview.gif" alt="preview" /></a><span class="preview"><input type="checkbox" id="online-image-' + data.insert_id + '" onchange="updateOnline(\'image\', ' + data.insert_id + ');" /><img src="js/web_offline.gif" class="onoff" alt="online/offline" /></span><img src="../wpdata/images/' + data.insert_id + '-s.jpg" class="thumb" onclick="$(this).slideUp(100); return false;" /></li>';
                            if (data.file_ext) {
                              liHTML = '<li class="sort-li" id="' + data.insert_id + '"><img src="js/handle.gif" alt="move" class="move" /> <img src="js/edit.gif" alt="edit" class="edit" onclick="$(this).siblings(\'.editor\').css(\'display\', \'inline\'); $(this).siblings(\'.preview\').css(\'display\', \'none\'); trapEnter(\'#edit-' + data.insert_id + '\', ' + data.insert_id + ', \'file\');" /><span class="editor"><input type="text" id="edit-' + data.insert_id + '" value="' + data.image_title + '" /><input type="button" value="save" onclick="saveTitle(\'#edit-' + data.insert_id + '\', ' + data.insert_id + ', \'file\');" /><img src="js/loading.gif" alt="loading" class="edit-no-show" /><input type="button" id="edit-cancel-' + data.insert_id + '" value="cancel" onclick="$(this).parent().siblings(\'.preview\').css(\'display\', \'inline\'); $(this).parent().css(\'display\', \'none\'); releaseEnter();" /> or remove this file <img src="js/unlink.gif" alt="un-link" class="unlink" onclick="if (window.confirm (\'Are you sure?\')) { deleteFile(\'file\', ' + data.insert_id + '); $(this).parent().parent().hide(\'fast\'); }" /></span><span class="preview"><img src="img/ico-file/' + data.file_ext + '.gif" alt="Preview" width="16" height="16" /> <a href="file-preview.php?file=files/' + data.insert_id + '.' + data.file_ext + '&filename=' + data.image_title + '.' + data.file_ext + '">' + data.image_title + '</a><input type="checkbox" id="online-file-' + data.insert_id + '" onchange="updateOnline(\'file\', ' + data.insert_id + ');" /><img src="js/web_offline.gif" class="onoff" alt="online/offline" /></span></li>';
                            }
                            $(this).parent().parent().append(liHTML).SortableAddItem(document.getElementById(data.insert_id));
                            $(this).parent().remove();
                          });
						} else {
                          alert(data.error);
						  $('#'+tempID).slideUp(500);
                        }
						$('#'+parentID+' ul').Sortable({
						  accept: 'sort-li',
						  helperclass: 'sortHelper',
						  activeclass : 	'sortActive',
						  hoverclass : 	'sortHover',
						  tolerance: 'pointer',
						  opacity: 0.9
						});
					} else {
                      alert(typeof(data));
					  $('#'+tempID).slideUp(500);
                    }
				},
				error: function (data, status, e)
				{
					alert('ajax error\n' + e + '\n' + data + '\n' + status);
                    for (i in e) {
                      alert(e[i]);
                    }
					$('#'+tempID).slideUp(500);
				}
			}
		);
		
		$('#'+elemID).val('');
		return false;
	}
	</script>
          </div> 
        </div> 
      </form> 
    </div> 
    <? require ("tpl/inc/footer.php"); ?> 
  </div> 
</div> 
<script type="text/javascript">
$('#video').change(
	function () {
		var text = $('#video :selected').text();
		var split = text.split(',');
		var address = split[0];
		var suburb = split[1];

		$('#videourl').val($(this).val());

		$('#address').val(address);
		$('#suburb').val(suburb);

		$('#update').click();
	}
);

</script>

</body>
</html>
