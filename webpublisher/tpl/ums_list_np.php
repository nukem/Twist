<?php
$sql = 'SELECT * FROM np_categories';
$query = mysql_query($sql) or die(mysql_error());

$cats = array();

$i = 0;
while($row = mysql_fetch_array($query)) {
	$cats[$i] = $row;
	$id = mysql_real_escape_string($row['categoryid']);

	$subscribers = dbq('SELECT COUNT(custid_fk) AS count FROM np_customer_category WHERE categoryid_fk = ' . $id);
	$subscribers = array_shift($subscribers);

	$cats[$i]['subscribers'] = $subscribers['count'];

	$i++;
}

?>
								<div id="np" class="">

										<div class="ums-header">
											<h2>Newsletter Pro Administration</h2>
										</div>

										<div class="list-controls">
											<div class="add-user">
												<a href="index.php?id=312&amp;mode=add_np_category">
													<img src="img/ums/add.jpg" />
													Add a category
												</a>
											</div>
										</div>
										<table class="tablesorter width-100pct">
											<tr>
												<th>Category Name</th>
												<th>Subscribers</th>
												<th></th>
											</tr>
											<tr>
<?php
foreach($cats as $c) {
?>
											<tr>
												<td><?php echo $c['category_name']; ?></td>
												<td><?php echo $c['subscribers']; ?></td>
												<td><a href="?id=<?php echo $cfg['ums_id']; ?>&amp;mode=np_category_details&amp;catid=<?php echo $c['categoryid']; ?>">
														<nobr>
														<img src="img/ums/edit.gif" />
														Edit Category
														</nobr>
													</a>
												</td>
											</tr>
<?php
}
?>

										</table>
									</div>
								</div>
