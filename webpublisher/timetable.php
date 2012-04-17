<?

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
   {$cfg['db']['prefix']}_timetable
  SET
   title = '" . addslashes ($_POST['title']) . "',
   content = '" . addslashes (preg_replace('/src="..\//', 'src="', $_POST['content'])) . "',
   uri = '$uri',
   online = $online,
   sort = '{$_POST['sort']}',
   position = {$_POST['position']},
   title_1 = '{$_POST['title_1']}',
   title_2 = '{$_POST['title_2']}',
   title_3 = '{$_POST['title_3']}',
   title_4 = '{$_POST['title_4']}',
   title_5 = '{$_POST['title_5']}',
   title_6 = '{$_POST['title_6']}',
   title_7 = '{$_POST['title_7']}',
   title_8 = '{$_POST['title_8']}',
   title_9 = '{$_POST['title_9']}',
   title_10 = '{$_POST['title_10']}',
   modified = '$time',
   viewRights = '$viewRights',
   createRights = '$createRights',
   editRights = '$editRights',
   deleteRights = '$deleteRights'
  WHERE
   link = id AND
   id = $id");
}

?>
