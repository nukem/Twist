 <p class="buttons">
  <? if (ereg ("({$user['parent']})", $record['editRights']) || $id == 0) { ?> 
	  <? if ($id != 0) { ?>
	  <input type="checkbox" name="online" value="1"<? if (isset ($_POST['online']) || (! isset ($_POST['title']) && $record['online'] == 1)) echo ' checked="checked"'; ?> /> &nbsp;<label><?= $lang[47] ?></label>&nbsp;
	  <? } ?>
  <input type="submit" name="save" value="<?= $lang[20] ?>" class="button" /> &nbsp;
  <? } ?> 
  <? if (ereg ("({$user['parent']})", $record['createRights']) && $record['type'] != 'user' && $record['type'] != 'webuser') { ?> 
  <select name="createType" class="textfield"> 
    <? if ($record['parent'] == 1) { ?> 
    <option value="user"><?= $lang[21] ?></option> 
    <? } ?> 
    <? if ($record['parent'] != 1 && $id != 571) { ?> 
    <option value="folder"><?= $lang[22] ?></option> 
    <? } ?> 
    <? if ($record['parent'] != 1 && $id != 1 && $id != 0) { ?> 
    <option value="article"><?= $lang[23] ?></option> 
    <option value="image"><?= $lang[24] ?></option> 
    <option value="video">New Video</option> 
    <option value="menu">New Menu Item</option> 
    <option value="submenu">New Submenu Item</option> 
    <option value="location">New Business Location</option> 
    <option value="link">New Link</option> 
    <option value="profile">New Staff Profile</option> 
    <option value="club">New Club</option> 
    <option value="product">New Product</option> 
    <option value="belt">New Belt</option> 
    <option value="timetable">New Time Table</option> 
    <option value="calendar">New Calendar</option> 
    <option value="logo">New Logo</option> 
    <option value="form">New Form</option> 
	<option value="category">New Category</option> 
	<option value="size">New Size</option> 
	<option value="nail">New Nail</option> 
	<option value="fabric">New Fabric</option> 
	<option value="leather">New Leather</option>
	<option value="legs">New Legs</option> 	
	<option value="model">New Model</option> 
    <? } ?>
  </select>
  <? if($record['type'] != 'webuser'){ ?>
  <select name="times" class="textfield">
  	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
  </select>
  <input type="hidden" name="currid" value="<?php if( isset($record['id']) ) { echo $record['id']; }else{ echo '0'; } ?>" />
  <input type="submit" name="create" value="<?= $lang[26] ?>" class="button" /> 
  <? } ?>
  <? if (isset ($_SESSION['epClipboard']) && $record['parent'] != 1 && $id != 1 && $id != 0) { ?>
  <input type="submit" name="paste<? if (isset($_SESSION['clipboardCopy']) && $_SESSION['clipboardCopy'] === true) echo 'Copy' ?>" value="<?= $lang[27] ?>" class="button" /> 
  <? } ?>
  <? } ?> 
  <? if (ereg ("({$user['parent']})", $record['deleteRights'])) { ?> 
  <? if (! isset ($_SESSION['epClipboard']) && $record['type'] != 'user' && $record['parent'] != 1 && $id != 1) { ?>
  <input type="submit" name="cut" value="<?= $lang[28] ?>" class="button" /> 
  	<? /*if ($record['type'] == 'article') { */?>
	<input type="submit" name="copy" value="Copy" class="button" /> 
	<? /*}*/ ?>
  <? } ?>
  <input type="submit" name="delete" value="<?= $lang[29] ?>" class="button" onclick="if (! window.confirm ('<?= $lang[31] ?>')) return (false);" /> 
  <? } ?> 
</p>
