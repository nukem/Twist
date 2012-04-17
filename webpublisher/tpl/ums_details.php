<?php 
// details

if(isset($_GET['userid'])) {
	$userid = $_GET['userid'];
} else {
	header('Location:index.php?id=' . $_GET['id']);
}

$sql = 'SELECT * FROM ums_user u
INNER JOIN ums_user_details d ON u.id = d.userid WHERE userid = ' . $userid;

$query = mysql_query($sql);

$u = mysql_fetch_array($query);

if(isset($u) && !empty($u)) {
	foreach($u as $k => $v) {
		$u[$k] = stripslashes($v);
	}
}

$log_sql = 'SELECT * FROM ums_log WHERE userid = ' . $userid . ' ORDER BY timestamp DESC';
$query = mysql_query($log_sql);
$logs = array();
while($row = mysql_fetch_array($query)) {
	$logs[] = $row;
}
$np_categories = dbq('SELECT * FROM np_categories');
$np_subscriptions = dbq('SELECT * FROM np_customer_category WHERE custid_fk = ' . $userid);
$np_cats = array();
foreach($np_categories as $cat) {
	$np_cats[$cat['categoryid']] = $cat['category_name'];
}
$np_subs = array();
if(isset($np_subscriptions) && !empty($np_subscriptions)) {
	foreach($np_subscriptions as $sub) {
		$np_subs[] = $sub['categoryid_fk'];
	}
}
?>


<? require ("inc/head.php"); ?>
<body> 
	<div id="page"> 
		<? require ("inc/header.php"); ?> 
		<? require ("inc/path.php"); ?> 
		<div id="content"> 
			<div id="left-col"> 
				<div id="left-col-border"> 
					<? require ("inc/structure.php"); ?> 
				</div> 
			</div> 
			<div id="right-col"> 
				<h2 class="bar green"><span>V-Series UMS</span></h2> 
				<div class="right-col-padding1"> 
					<div class="width-99pct"> 
						<table class="rec-table"> 
							<tr>
								<td colspan="3">

									<p>
										<a href="index.php?id=312">&laquo; View all contacts</a>
									</p>

									<div class="tabs">

										<ul>
											<li>
												<a href="#details">
													<img src="img/ums/user.gif" />
													View Details
												</a>
											</li>
											<li>
												<a href="#edit">
													<img src="img/ums/edit-grey.gif" />
													Edit Details
												</a>
											</li>
											<li class="delete-tab">
												<a href="#delete" class="delete-link">
													<img src="img/ums/delete.gif" />
													Delete User
												</a>
											</li>
										</ul>

										<div id="details">

											<table>
												<tr>
													<th>Title</th>
													<td><?php echo $u['title']; ?></td>
												</tr>
												<tr>
													<th>First Name</th>
													<td class="first_name"><?php echo $u['first_name']; ?></td>
												</tr>
												<tr>
													<th>Initial</th>
													<td class="initial"><?php echo $u['initial']; ?></td>
												</tr>
												<tr>
													<th>Last Name</th>
													<td class="last_name"><?php echo $u['last_name']; ?></td>
												</tr>
												<tr>
													<th>Company</th>
													<td class="company"><?php echo $u['company']; ?></td>
												</tr>
												<tr>
													<th>Email</th>
													<td class="email"><?php echo $u['email']; ?></td>
												</tr>
												<tr>
													<th>Phone</th>
													<td class="phone"><?php echo $u['phone']; ?></td>
												</tr>
												<tr>
													<th>Mobile</th>
													<td class="mobile"><?php echo $u['mobile']; ?></td>
												</tr>
												<tr>
													<th>Address</th>
													<td class="address"><?php echo $u['address']; ?></td>
												</tr>
												<tr>
													<th>Suburb</th>
													<td class="suburb"><?php echo $u['suburb']; ?></td>
												</tr>
												<tr>
													<th>Postcode</th>
													<td class="postcode"><?php echo $u['postcode']; ?></td>
												</tr>
												<tr>
													<th>State</th>
													<td class="state"><?php echo $u['state']; ?></td>
												</tr>
												<tr>
													<th>Country</th>
													<td class="country"><?php echo $u['country']; ?></td>
												</tr>
												<tr>
													<th>Subscribed to Newsletter Pro</th>
													<td class="newsletterpro"><?php echo ($u['subscribe'] == 1) ? 'Yes': 'No'; ?></td>
												</tr>
												<tr>
													<th>Newsletter Pro Subscriptions</th>
													<td class="subscriptions">
<?php
if(count($np_subscriptions) == 0) {
	echo 'User is not subscribed to any Newsletter Pro newsletters';
} else {
	$subscriptions = array();
	foreach($np_subs as $sub) {
		$subscriptions[] = $np_cats[$sub];
	}
	echo trim(implode(', ', $subscriptions), ', ');
}
?>
													
													</td>
												</tr>
											</table>
										</div>

										<div id="edit">



											<form action="ums_update_user.php" action="post" onsubmit="return updateUser($(this));">

												<div class="message" style="display: none;"></div>

												<table>
													<tr>
														<th>Title</th>
														<td><div class="textfield"><input type="text" name="title" value="<?php echo $u['title']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>First Name</th>
														<td><div class="textfield"><input type="text" name="first_name" value="<?php echo $u['first_name']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Initial</th>
														<td><div class="textfield"><input type="text" name="initial" value="<?php echo $u['initial']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Last Name</th>
														<td><div class="textfield"><input type="text" name="last_name" value="<?php echo $u['last_name']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Company</th>
														<td><div class="textfield"><input type="text" name="company" value="<?php echo $u['company']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Email</th>
														<td><div class="textfield"><input type="text" name="email" value="<?php echo $u['email']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Phone</th>
														<td><div class="textfield"><input type="text" name="phone" value="<?php echo $u['phone']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Mobile</th>
														<td><div class="textfield"><input type="text" name="mobile" value="<?php echo $u['mobile']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Address</th>
														<td><div class="textfield"><input type="text" name="address" value="<?php echo $u['address']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Suburb</th>
														<td><div class="textfield"><input type="text" name="suburb" value="<?php echo $u['suburb']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Postcode</th>
														<td><div class="textfield"><input type="text" name="postcode" value="<?php echo $u['postcode']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>State</th>
														<td><div class="textfield"><input type="text" name="state" value="<?php echo $u['state']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Country</th>
														<td><div class="textfield"><input type="text" name="country" value="<?php echo $u['country']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Subscribed to Newsletter</th>
														<td><div class="textfield">
															<label>
																<input type="radio" name="subscribe" value="1" class="" <?php echo ($u['subscribe'] == 1) ? 'checked="checked"' : ''; ?> />
																Yes
															</label>
															<label>
																<input type="radio" name="subscribe" value="0" class="" <?php echo ($u['subscribe'] == 0) ? 'checked="checked"' : ''; ?> />
																No
															</label>
														</div></td>
													</tr>
													<tr>
														<th>Newsletter Pro Subscriptions</th>
														<td><div class="textfield">
<?php
foreach($np_categories as $cat) {
?>
															<label>
																<input type="checkbox" name="np_category[]" value="<?php echo $cat['categoryid']; ?>" class="" <?php echo (in_array($cat['categoryid'], $np_subs)) ? 'checked="checked"' : ''; ?>/>
																<?php echo $cat['category_name']; ?>
															</label>
<?php
}
?>
														</div></td>
													</tr>
													<tr>
														<th></th>
														<td>
															<input type="hidden" value="<?php echo $u['userid']; ?>" name="userid" />
															<button class="button" type="submit">Save Details</button>
														</td>
													</tr>
												</table>
											</form>

										</div>

										<div id="delete">

											<h2>Are you sure that you wish to delete this?</h2>
											<p>Please be aware that once a client is removed from the database they will be removed permanently</p>
											<form action="ums_delete_user.php" method="post">
												<input type="hidden" value="<?php echo $u['userid']; ?>" name="userid" />
												<p><button class="button" type="submit" >Yes! I wish to delete this user.</button></p>
											</form>

										</div>

									</div>

								</td>
								<td>

									<div class="logs">

										<h2>Client Logs</h2>

										<div class="add-log">
											<form action="ums_add_log.php" method="post" onsubmit="return addLog($(this));">
												
												<div class="message" style="display: none;"></div>
												<div>
													<label>
														<span>Name</span>
														<div class="textfield"><input type="text" name="name" class="width-100pct" /></div>
													</label>
												</div>
												<div>
													<label>
														<span>Message</span>
														<div class="textfield"><textarea name="contents" class="width-100pct"></textarea></div>
													</label>
												</div>
												<div>
													<input type="hidden" value="<?php echo $u['userid']; ?>" name="userid" />
													<button class="button" type="submit">Add Log</button>
												</div>
											</form>
										</div>

										<div class="previous-logs">
<?php
foreach($logs as $log) {
	$date = date('H:i d-m-Y', strtotime($log['timestamp']));
	$comments = nl2br(stripslashes($log['contents']));
	echo <<<HTML

		<div class="log-data">
			<div class="log-vitals">
				<div class="log-name">{$log['name']}</div>
				<div class="log-timestamp">{$date}</div>
			</div>

			<div class="log-contents">
				{$comments}
			</div>
		</div>

HTML;
}
?>

										</div>


									</div>

								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<? require ("inc/footer.php"); ?> 
		</div> 
	</div> 
</body>
</html>
