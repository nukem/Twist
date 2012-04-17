<?

if (! isset ($errorsChecked)) {
 if (! ereg ('.+', $_POST['title']))
  $errors[] = $lang[103];
 if (dbq ("SELECT * FROM {$cfg['db']['prefix']}_structure WHERE parent = {$record['parent']} AND id <> $id AND title = '" . addslashes ($_POST['title']) . "' AND title <> ''"))
  $errors[] = $lang[104];
 $uri = strtolower (ereg_replace ('[^A-Za-z0-9]+', '-', strip_accents ($_POST['title'])));
 if (! isset ($errors) && dbq ("SELECT * FROM {$cfg['db']['prefix']}_structure WHERE parent = {$record['parent']} AND id <> $id AND uri = '$uri' AND uri <> ''"))
  $errors[] = $lang[105];
 if(!isset($_POST['product_postage1']) || $_POST['product_postage1'] == "" || $_POST['product_postage1'] == null){
  $errors[] = $lang[122];
 }
 if(!isset($_POST['product_postage2']) || $_POST['product_postage2'] == "" || $_POST['product_postage2'] == null){
  $errors[] = $lang[123];
 }
 if(!isset($_POST['product_postage3']) || $_POST['product_postage3'] == "" || $_POST['product_postage3'] == null){
  $errors[] = $lang[124];
 }
 $errorsChecked = true;
} else {


 if ($record['position'] != $_POST['position'])
  dbq ("UPDATE {$cfg['db']['prefix']}_structure SET position = position + 1 WHERE position >= {$_POST['position']} ORDER BY position DESC");
 dbq ("UPDATE
   {$cfg['db']['prefix']}_structure,
   {$cfg['db']['prefix']}_product
  SET
   title = '" . addslashes ($_POST['title']) . "',
   uri = '$uri',
   online = $online,
   sort = '{$_POST['sort']}',
   position = {$_POST['position']},
   modified = '$time',
   price = '{$_POST['price']}',
   product_code = '{$_POST['product_code']}',
   product_postage1 = '{$_POST['product_postage1']}',
   product_postage2 = '{$_POST['product_postage2']}',
   product_postage3 = '{$_POST['product_postage3']}',
   sizes = '{$_POST['sizes']}',
   colours = '{$_POST['colours']}',
   viewRights = '$viewRights',
   createRights = '$createRights',
   editRights = '$editRights',
   deleteRights = '$deleteRights',
   content = '" . addslashes (preg_replace('/src="..\//', 'src="', $_POST['content'])) . "'
  WHERE
   link = id AND
   id = $id");
}

?>
