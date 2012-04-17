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
      <h2 class="bar green"><span><?= $lang[58] ?></span></h2> 
      <form action=".?id=<?= $id ?>" method="post" enctype="multipart/form-data" > 
        <? require ("tpl/inc/buttons.php"); ?> 
        <div class="right-col-padding1"> 
          <div class="width-99pct"> 
            <table class="rec-table"> 
              <? require ("tpl/inc/record.php"); ?> 
          
			  <tr>
				<td colspan="2">
					<?php
					$belts = dbq('SELECT * FROM wp_structure, wp_category WHERE id = link');
					?>
					<label>Category</label><br />
					<select name="category" class="width-100pct textfield">
						<option></option>
					<?php
					$curr_value = show_value('category');
					foreach($belts as $b) {
						$selected = '';
						if(!empty($curr_value) && ($b['id'] == show_value('category'))) {
							$selected = 'selected="selected"';
						}
					?>
											<option value="<?php echo $b['id']; ?>" <?php echo $selected; ?> ><?php echo $b['title']; ?></option>
					<?php
					}
					?>
					</select>
				</td>
			  </tr>
              <tr> 
                <td colspan="4"> 
				<label>Description</label><br />
					<textarea name="description" cols="30" rows="10" class="textfield height-200 tinymce"><? if (isset ($_POST['description'])) echo htmlspecialchars ($_POST['description']); else echo htmlspecialchars (preg_replace('/src="/', 'src="../', $record['description'])); ?></textarea>
                </td> 
              </tr>     
			  <tr>
				<td colspan="1" >
				  <div style="border:1px solid #cecece;padding:10px;">
				  <?php
					$belts = dbq('SELECT * FROM wp_structure, wp_fabric WHERE id = link');
					?>
					<label>Fabrics</label><br />
					<select id="fabric-add" name="fabric-add" class="width-100pct textfield">
						<option></option>
					<?php
					$curr_value = show_value('category');
					foreach($belts as $b) {
						$selected = '';
						if(!empty($curr_value) && ($b['id'] == show_value('category'))) {
							$selected = 'selected="selected"';
						}
					?>
											<option value="<?php echo $b['id']; ?>" <?php echo $selected; ?> ><?php echo $b['title']; ?></option>
					<?php
					}
					?>
					</select>
					<br />
					<label>Price</label><br />
					<span>$</span><input type="text" class="textfield" style="width:50%" value="" name="fabric-price-add" id="fabric-price-add" />
					<input type="button" value="Add Fabric" onClick="addModelElement('<?= $id ?>', 'fabric');"/>
					</div>
					<div id="image-parent">
						<ul id="image-sort">
						<?
						$linked_fabric = dbq("SELECT wm.*, ws.title FROM `wp_model_element` wm, `wp_fabric` wf, `wp_structure` ws WHERE ws.id = wf.link AND wm.type_id = wf.link AND wm.`parent` = '{$id}' AND wm.type = 'fabric' ORDER BY wm.`position`");
						if (is_array($linked_fabric)) {
						  foreach ($linked_fabric as $li) {
							?>
							<li class="sort-li" id="<?= $li['id'] ?>">
							  <img src="js/handle.gif" alt="move" class="move" />	
							  <img src="js/edit.gif" alt="edit" class="edit" onClick="$(this).siblings('.editor').css('display', 'inline'); $(this).siblings('.preview').css('display', 'none'); trapEnter('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'image');" />
							  <span class="editor">
								<br/>
								<span class="pic-title"><?= $li['title'] ?> </span>
								<input type="text" id="edit-<?= $li['id'] ?>" value="<?= $li['price'] ?>" /><br/>
								<input type="button" value="save" onClick="saveModelElement('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'fabric');" />
								<img src="js/loading.gif" alt="loading" class="edit-no-show" />
								<input type="button" id="edit-cancel-<?= $li['id'] ?>" value="cancel" onClick="$(this).parent().siblings('.preview').css('display', 'inline'); $(this).parent().css('display', 'none'); releaseEnter();" /> 
								<br/>or remove this image 
								<img src="js/unlink.gif" alt="un-link" class="unlink" onClick="if (window.confirm ('Are you sure?')) { deleteModelLink('image', <?= $li['id'] ?>); $(this).parent().parent().hide('fast'); }" />
							  </span>							  
							  <a href="?id=<?=$li['id']?>" title="preview" class="preview" onClick="$(this).siblings('.editor').css('display', 'inline'); $(this).parent().find('.preview').css('display', 'none'); trapEnter('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'image'); return false;" >
								<span class="pic-title"><?= $li['title'] ?> - $<?= $li['price'] ?></span>
							  </a>
							  <span class="preview">
								<input type="checkbox" id="online-fabric-<?= $li['id'] ?>" onChange="updateOnline('fabric', <?= $li['id'] ?>);"<? if ($li['online'] == 1) echo ' checked="checked"'; ?> />
								<img src="js/web_<? if ($li['online'] == 1) echo 'online'; else echo 'offline' ?>.gif" class="onoff" alt="online/offline" />
							  </span>								
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
				<td colspan="1">				  
				  <div style="border:1px solid #cecece;padding:10px;">
				  <?php
					$belts = dbq('SELECT * FROM wp_structure, wp_nail WHERE id = link');
					?>
					<label>Nail head / Accessories</label><br />
					<select id="nail-add" name="nail-add" class="width-100pct textfield">
						<option></option>
					<?php
					$curr_value = show_value('category');
					foreach($belts as $b) {
						$selected = '';
						if(!empty($curr_value) && ($b['id'] == show_value('category'))) {
							$selected = 'selected="selected"';
						}
					?>
								<option value="<?php echo $b['id']; ?>" <?php echo $selected; ?> ><?php echo $b['title']; ?></option>
					<?php
					}
					?>
					</select>
					<br />
					<label>Price</label><br />
					<span>$</span><input type="text" class="textfield" style="width:50%" value="" name="nail-price-add" id="nail-price-add" />
					<input type="button" value="Add Nail head" onClick="addModelElement('<?= $id ?>', 'nail');" />
					</div>
					<div id="image-parent">
						<ul id="image-sort">
						<?
						$linked_nail = dbq("SELECT wm.*, ws.title FROM `wp_model_element` wm, `wp_nail` wn, `wp_structure` ws WHERE ws.id = wn.link AND wm.type_id = wn.link AND wm.`parent` = '{$id}' AND wm.type = 'nail' ORDER BY wm.`position`");
						if (is_array($linked_nail)) {
						  foreach ($linked_nail as $li) {
							?>
							<li class="sort-li" id="<?= $li['id'] ?>">
							  <img src="js/handle.gif" alt="move" class="move" />	
							  <img src="js/edit.gif" alt="edit" class="edit" onClick="$(this).siblings('.editor').css('display', 'inline'); $(this).siblings('.preview').css('display', 'none'); trapEnter('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'image');" />
							  <span class="editor">
								<br/>
								<span class="pic-title"><?= $li['title'] ?> </span>
								<input type="text" id="edit-<?= $li['id'] ?>" value="<?= $li['price'] ?>" /><br/>
								<input type="button" value="save" onClick="saveModelElement('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'nail');" />
								<img src="js/loading.gif" alt="loading" class="edit-no-show" />
								<input type="button" id="edit-cancel-<?= $li['id'] ?>" value="cancel" onClick="$(this).parent().siblings('.preview').css('display', 'inline'); $(this).parent().css('display', 'none'); releaseEnter();" /> 
								<br/>or remove this image 
								<img src="js/unlink.gif" alt="un-link" class="unlink" onClick="if (window.confirm ('Are you sure?')) { deleteModelLink('image', <?= $li['id'] ?>); $(this).parent().parent().hide('fast'); }" />
							  </span>							  
							  <a href="?id=<?=$li['id']?>" title="preview" class="preview" onClick="$(this).siblings('.editor').css('display', 'inline'); $(this).parent().find('.preview').css('display', 'none'); trapEnter('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'image'); return false;" >
								<span class="pic-title"><?= $li['title'] ?> - $<?= $li['price'] ?></span>
							  </a>
							  <span class="preview">
								<input type="checkbox" id="online-nail-<?= $li['id'] ?>" onChange="updateOnline('nail', <?= $li['id'] ?>);"<? if ($li['online'] == 1) echo ' checked="checked"'; ?> />
								<img src="js/web_<? if ($li['online'] == 1) echo 'online'; else echo 'offline' ?>.gif" class="onoff" alt="online/offline" />
							  </span>								
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
				<td colspan="1">				  
				  <div style="border:1px solid #cecece;padding:10px;">
				  <?php
					$belts = dbq('SELECT * FROM wp_structure, wp_legs WHERE id = link');
					?>
					<label>Legs / Finish</label><br />
					<select id="legs-add" name="legs-add" class="width-100pct textfield">
						<option></option>
					<?php
					$curr_value = show_value('category');
					foreach($belts as $b) {
						$selected = '';
						if(!empty($curr_value) && ($b['id'] == show_value('category'))) {
							$selected = 'selected="selected"';
						}
					?>
											<option value="<?php echo $b['id']; ?>" <?php echo $selected; ?> ><?php echo $b['title']; ?></option>
					<?php
					}
					?>
					</select>
					<br />
					<label>Price</label><br />
					<span>$</span><input type="text" class="textfield" style="width:50%" value="<?php echo show_value('product_postage1'); ?>" name="legs-price-add" id="legs-price-add" />
					<input type="button" value="Add Legs" onClick="addModelElement('<?= $id ?>', 'legs');"  />
					</div>
					<div id="image-parent">
						<ul id="image-sort">
						<?
						$linked_legs = dbq("SELECT wm.*, ws.title FROM `wp_model_element` wm, `wp_legs` wl, `wp_structure` ws WHERE ws.id = wl.link AND wm.type_id = wl.link AND wm.`parent` = '{$id}' AND wm.type = 'legs' ORDER BY wm.`position`");
						if (is_array($linked_legs)) {
						  foreach ($linked_legs as $li) {
							?>
							<li class="sort-li" id="<?= $li['id'] ?>">
							  <img src="js/handle.gif" alt="move" class="move" />	
							  <img src="js/edit.gif" alt="edit" class="edit" onClick="$(this).siblings('.editor').css('display', 'inline'); $(this).siblings('.preview').css('display', 'none'); trapEnter('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'image');" />
							  <span class="editor">
								<br/>
								<span class="pic-title"><?= $li['title'] ?> </span>
								<input type="text" id="edit-<?= $li['id'] ?>" value="<?= $li['price'] ?>" /><br/>
								<input type="button" value="save" onClick="saveModelElement('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'legs');" />
								<img src="js/loading.gif" alt="loading" class="edit-no-show" />
								<input type="button" id="edit-cancel-<?= $li['id'] ?>" value="cancel" onClick="$(this).parent().siblings('.preview').css('display', 'inline'); $(this).parent().css('display', 'none'); releaseEnter();" /> 
								<br/>or remove this image 
								<img src="js/unlink.gif" alt="un-link" class="unlink" onClick="if (window.confirm ('Are you sure?')) { deleteModelLink('image', <?= $li['id'] ?>); $(this).parent().parent().hide('fast'); }" />
							  </span>							  
							  <a href="?id=<?=$li['id']?>" title="preview" class="preview" onClick="$(this).siblings('.editor').css('display', 'inline'); $(this).parent().find('.preview').css('display', 'none'); trapEnter('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'image'); return false;" >
								<span class="pic-title"><?= $li['title'] ?> - $<?= $li['price'] ?></span>
							  </a>
							  <span class="preview">
								<input type="checkbox" id="online-legs-<?= $li['id'] ?>" onChange="updateOnline('legs', <?= $li['id'] ?>);"<? if ($li['online'] == 1) echo ' checked="checked"'; ?> />
								<img src="js/web_<? if ($li['online'] == 1) echo 'online'; else echo 'offline' ?>.gif" class="onoff" alt="online/offline" />
							  </span>								
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
				<td colspan="1">				  
				  <div style="border:1px solid #cecece;padding:10px;">
				  <?php
					$belts = dbq('SELECT * FROM wp_structure, wp_leather WHERE id = link');
					?>
					<label>Leather</label><br />
					<select id="leather-add" name="leather-add"  class="width-100pct textfield">
						<option></option>
					<?php
					$curr_value = show_value('category');
					foreach($belts as $b) {
						$selected = '';
						if(!empty($curr_value) && ($b['id'] == show_value('category'))) {
							$selected = 'selected="selected"';
						}
					?>
											<option value="<?php echo $b['id']; ?>" <?php echo $selected; ?> ><?php echo $b['title']; ?></option>
					<?php
					}
					?>
					</select>
					<br />
					<label>Price</label><br />
					<span>$</span><input type="text" class="textfield" style="width:50%" value="<?php echo show_value('product_postage1'); ?>" name="leather-price-add" id="leather-price-add" />
					<input type="button" value="Add Leather" onClick="addModelElement('<?= $id ?>', 'leather');"  />
					</div>
					<div id="image-parent">
						<ul id="image-sort">
						<?
						$linked_leatherr = dbq("SELECT wm.*, ws.title FROM `wp_model_element` wm, `wp_leather` wl, `wp_structure` ws WHERE ws.id = wl.link AND wm.type_id = wl.link AND wm.`parent` = '{$id}' AND wm.type = 'leather' ORDER BY wm.`position`");
						if (is_array($linked_leatherr)) {
						  foreach ($linked_leatherr as $li) {
							?>
							<li class="sort-li" id="<?= $li['id'] ?>">
							  <img src="js/handle.gif" alt="move" class="move" />	
							  <img src="js/edit.gif" alt="edit" class="edit" onClick="$(this).siblings('.editor').css('display', 'inline'); $(this).siblings('.preview').css('display', 'none'); trapEnter('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'image');" />
							  <span class="editor">
								<br/>
								<span class="pic-title"><?= $li['title'] ?> </span>
								<input type="text" id="edit-<?= $li['id'] ?>" value="<?= $li['price'] ?>" /><br/>
								<input type="button" value="save" onClick="saveModelElement('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'leather');" />
								<img src="js/loading.gif" alt="loading" class="edit-no-show" />
								<input type="button" id="edit-cancel-<?= $li['id'] ?>" value="cancel" onClick="$(this).parent().siblings('.preview').css('display', 'inline'); $(this).parent().css('display', 'none'); releaseEnter();" /> 
								<br/>or remove this image 
								<img src="js/unlink.gif" alt="un-link" class="unlink" onClick="if (window.confirm ('Are you sure?')) { deleteModelLink('image', <?= $li['id'] ?>); $(this).parent().parent().hide('fast'); }" />
							  </span>							  
							  <a href="?id=<?=$li['id']?>" title="preview" class="preview" onClick="$(this).siblings('.editor').css('display', 'inline'); $(this).parent().find('.preview').css('display', 'none'); trapEnter('#edit-<?= $li['id'] ?>', <?= $li['id'] ?>, 'image'); return false;" >
								<span class="pic-title"><?= $li['title'] ?> - $<?= $li['price'] ?></span>
							  </a>
							  <span class="preview">
								<input type="checkbox" id="online-leather-<?= $li['id'] ?>" onChange="updateOnline('leather', <?= $li['id'] ?>);"<? if ($li['online'] == 1) echo ' checked="checked"'; ?> />
								<img src="js/web_<? if ($li['online'] == 1) echo 'online'; else echo 'offline' ?>.gif" class="onoff" alt="online/offline" />
							  </span>								
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
			  </tr>			  
			  <tr>
				<td colspan="2">
				  <label>Upload  Picture</label><br />
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
	
	function addModelElement(parent,type) {
	  var num = '';
	  var type_id = $('#' +type+'-add').val();
	  var price = $('#' +type+'-price-add').val();
      var titleDetails;
      $.get(
        'savemodelprice.php?t='+type,
        {'price' : price, 'id': num, 'type_id': type_id, 'parent' :parent},
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
    
	
	function saveModelElement(id, num, type) {
      $(id).siblings('.edit-no-show').css('display', 'inline');
      var titleDetails;
      $.get(
        'savemodelprice.php?t='+type,
        {'price' : $(id).val(), 'id': num},
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
	
	function deleteModelLink(type, id) {
      $.get(
        'deletemodellink.php?t=' + new Date().getTime(),
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
</body>
</html>
