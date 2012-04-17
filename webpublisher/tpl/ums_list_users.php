<?php 
// list

$sql = '
SELECT * FROM ums_user u
INNER JOIN ums_user_details d ON u.id = d.userid
';

if(isset($_GET['search_term'])) {
	$sql .=
		'WHERE
		d.`first_name` LIKE "%' . $_GET['search_term'] . '%" OR
		d.`last_name` LIKE "%' . $_GET['search_term'] . '%" OR
		d.`company` LIKE "%' . $_GET['search_term'] . '%"';
}

if(isset($_GET['order'])) {
	$sql .= ' ORDER BY ' . $_GET['order'];
}

if(isset($_GET['direction'])) {
	$sql .= ' ' . $_GET['direction'];
}

$query = mysql_query($sql);

$last_log = 'SELECT * FROM ums_log WHERE userid = %userid% ORDER BY timestamp DESC LIMIT 1';
$users = array();
$i = 0;
while($row = mysql_fetch_array($query)) {
	$users[$i] = $row;
	$last_log_sql = str_replace('%userid%', $row['id'], $last_log);
	$log_query = mysql_query(str_replace('%userid%', $row['id'], $last_log));
	$users[$i]['log'] = mysql_fetch_array($log_query);
	$i++;
}

$users_count = count($users);

$items_per_page = (isset($_GET['max'])) ? $_GET['max'] : 30;

$offset = (isset($_GET['offset'])) ? $_GET['offset'] : 0;
$pagination['max'] = ceil($users_count / $items_per_page);
for($i = 0; $i < $items_per_page * $offset; $i++) {
	unset($users[$i]);
}

$users = array_values($users);

for($i = $items_per_page; $i <= $users_count; $i++) {
	unset($users[$i]);
}

$order_link = $pagination['link'] = '?id=312';
$pagination['link'] .= (isset($_GET['order'])) ? '&amp;order=' . $_GET['order'] : '';
$pagination['link'] .= (isset($_GET['search_term'])) ? '&amp;search_term=' . $_GET['search_term'] : '';
$users = array_values($users);
$items_page_count = count($users);

$search_term = '';
if(isset($_GET['search_term'])) {
	$search_term = $_GET['search_term'];
}
?>

									<div id="users" class="users">
										<div class="ums-header">
											<h2 class="contact-list">Contact List</h2>
											<form method="post" action="ums_search.php"  class="search">
												<label>
													<span>Search Users: </span>
													<input type="text" name="search_term" class="textfield" value="<?php echo $search_term; ?>" />
												</label>
												<button class="button" type="submit">Search</button>
											</form>
										</div>

										<div class="list-controls">
											<div class="add-user">
												<a href="index.php?id=312&amp;mode=add">
													<img src="img/ums/add.jpg" />
													Add a new user
												</a>
											</div>

<?php
if(!empty($search_term)) {
?>
											<div class="show-all">
												<img src="img/ums/all.gif" />
												<a href="index.php?id=312">Show All Users</a>
											</div>
<?php
}
?>
										</div>
										<table class="tablesorter width-100pct">
											<tr>
												<th><a href="<?php echo $order_link; ?>&amp;order=first_name">First Name</a></th>
												<th><a href="<?php echo $order_link; ?>&amp;order=last_name">Last Name</a></th>
												<th><a href="<?php echo $order_link; ?>&amp;order=email">Email</a></th>
												<th><a href="<?php echo $order_link; ?>&amp;order=created">Added to UMS</a></th>
												<th>Last Log</th>
												<th></th>
											</tr>
											<tr>
												<td style="text-align: right;" colspan="6">
<?php
if($users_count > $items_per_page) {
	$pagination_start = ($offset - 5 >= 0) ? $offset - 5 : 0;
	$pagination_end = ($offset + 5 <= $pagination['max']) ? $offset + 5 : $pagination['max'];

	if($pagination_start <= 0) {
		$pagination_end = 10;
	}

	if($pagination_end >= $pagination['max']) {
		$pagination_start = $pagination['max'] - 10;
	}

	$pagination_html = <<<HTML
					<div class="pagination">
						<div class="pagination-links">
							<a href="./{$pagination['link']}&amp;offset=0" class="first">first</a>
HTML;
	if($offset > 0) {
		$tar_offset = $offset - 1;
		$pagination_html .= <<<HTML
							<a href="./{$pagination['link']}&amp;offset={$tar_offset}">&lt;</a>
HTML;
	}
for($i = $pagination_start; $i < $pagination_end; $i++) {
	if($i < 0 || $i >= $pagination['max']) {
		continue;
	}
	$page_no = $i + 1;
	$new_offset = $i;
	if($offset == $new_offset) {
		$pagination_html .= '<strong>';
	}
	$pagination_html .= <<<HTML
							<a href="./{$pagination['link']}&amp;offset={$new_offset}">{$page_no}</a>
HTML;
	if($offset == $new_offset) {
		$pagination_html .= '</strong>';
	}
}
	if($offset + 1 < $pagination['max']) {
		$tar_offset = $offset + 1;
		$pagination_html .= <<<HTML
							<a href="./{$pagination['link']}&amp;offset={$tar_offset}">&gt;</a>
HTML;
	}
	$tar_offset = $pagination['max'] - 1;
	$pagination_html .= <<<HTML
							<a href="./{$pagination['link']}&amp;offset={$tar_offset}" class="last">last</a>
						</div>
					</div>
HTML;
echo $pagination_html;
}
?>
												</td>
												
											</tr>
<?php
foreach($users as $u) {
?>
											<tr>
												<td><?php echo $u['first_name']; ?></td>
												<td><?php echo $u['last_name']; ?></td>
												<td><?php echo $u['email']; ?></td>
												<td><?php echo ($u['created'] != '0000-00-00 00:00:00') ? date('d-m-Y', strtotime($u['created'])) : ''; ?></td>
												<td><?php echo (!empty($u['log']['timestamp'])) ? date('d-m-Y G:i', strtotime($u['log']['timestamp'])) : ''; ?></td>
												<td><a href="?id=<?php echo $cfg['ums_id']; ?>&amp;mode=details&amp;userid=<?php echo $u['userid']; ?>">
														<nobr>
														<img src="img/ums/edit.gif" />
														View / Edit User's Details
														</nobr>
													</a>
												</td>
											</tr>
<?php
}
?>

<?php
if($users_count > $items_per_page) {
?>
											<tr>
												<td style="text-align: right;" colspan="6">
<?php
	echo $pagination_html;
?>
												</td>
											</tr>
<?php
}
?>
										</table>
									</div>
