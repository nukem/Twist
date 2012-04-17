<?php

if (! isset ($errorsChecked)) {
 if (! ereg ('.+', $_POST['title']))
  $errors[] = $lang[103];
 if (dbq ("SELECT * FROM {$cfg['db']['prefix']}_structure WHERE parent = {$record['parent']} AND id <> $id AND title = '" . addslashes ($_POST['title']) . "' AND title <> ''"))
  $errors[] = $lang[104];
 $uri = strtolower (ereg_replace ('[^A-Za-z0-9]+', '-', strip_accents ($_POST['title'])));
 if (! isset ($errors) && dbq ("SELECT * FROM {$cfg['db']['prefix']}_structure WHERE parent = {$record['parent']} AND id <> $id AND uri = '$uri' AND uri <> ''"))
  $errors[] = $lang[105];
 if (! isset ($_POST['online']) && $id == $user['parent'])
  $errors[] = $lang[107];
 $errorsChecked = true;
} else {
 if ($record['position'] != $_POST['position'])
	 dbq ("UPDATE {$cfg['db']['prefix']}_structure SET position = position + 1 WHERE position >= {$_POST['position']} ORDER BY position DESC");

 dbq ("UPDATE
   {$cfg['db']['prefix']}_structure,
   {$cfg['db']['prefix']}_video
  SET
   title = '" . addslashes ($_POST['title']) . "',
   videourl = '{$_POST['videourl']}',
   embed = '{$_POST['embed']}',
   image = '{$_POST['image']}',
   details = '" . mysql_real_escape_string($_POST['details']) . "',
   uri = '$uri',
   online = $online,
   sort = '{$_POST['sort']}',
   position = {$_POST['position']},
   modified = '$time',
   viewRights = '$viewRights',
   createRights = '$createRights',
   editRights = '$editRights',
   deleteRights = '$deleteRights'
  WHERE
   link = id AND
   id = $id");
}

