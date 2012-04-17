<?php 
// details
$catid = mysql_real_escape_string($_GET['catid']);
$category = dbq('SELECT * FROM np_categories WHERE categoryid = ' . $catid);
$category = array_shift($category);
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
										<a href="index.php?id=312#np">&laquo; View all categories</a>
									</p>

										<div id="edit">

											<form action="ums_update_np_category.php" method="post">

												<div class="message" style="display: none;"></div>

												<table>
													<tr>
														<th>Name</th>
														<td><div class="textfield"><input type="text" name="category_name" value="<?php echo $category['category_name']; ?>" class="width-100pct" /></div></td>
													</tr>
													<tr>
														<th></th>
														<td>
															<input type="hidden" name="category_id" value="<?php echo $category['categoryid']; ?>" />
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

