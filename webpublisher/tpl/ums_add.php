<?php 
// details
$np_categories = dbq('SELECT * FROM np_categories');
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
								<td colspan="4" class="tabs">

									<p>
										<a href="index.php?id=312">&laquo; View all contacts</a>
									</p>

										<div id="edit">

											<form action="ums_add_details.php" method="post">

												<div class="message" style="display: none;"></div>

												<table>
													<tr>
														<th>Title</th>
														<td><div class="textfield"><input type="text" name="title" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>First Name</th>
														<td><div class="textfield"><input type="text" name="first_name" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Initial</th>
														<td><div class="textfield"><input type="text" name="initial" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Last Name</th>
														<td><div class="textfield"><input type="text" name="last_name" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Company</th>
														<td><div class="textfield"><input type="text" name="company" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Email</th>
														<td><div class="textfield"><input type="text" name="email" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Phone</th>
														<td><div class="textfield"><input type="text" name="phone" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Mobile</th>
														<td><div class="textfield"><input type="text" name="mobile" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Address</th>
														<td><div class="textfield"><input type="text" name="address" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Suburb</th>
														<td><div class="textfield"><input type="text" name="suburb" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Postcode</th>
														<td><div class="textfield"><input type="text" name="postcode" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>State</th>
														<td><div class="textfield"><input type="text" name="state" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Country</th>
														<td><div class="textfield"><input type="text" name="country" value="" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th>Subscribed to Newsletter</th>
														<td><div class="textfield">
															<label>
																<input type="radio" name="subscribe" value="1" class="" />
																Yes
															</label>
															<label>
																<input type="radio" name="subscribe" value="0" class="" />
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
																<input type="checkbox" name="np_category[]" value="<?php echo $cat['categoryid']; ?>" class="" />
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
															<button class="button" type="submit">Save Details</button>
														</td>
													</tr>
												</table>
											</form>

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

