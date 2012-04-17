

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
								<td colspan="4">

									<div class="tabs">
										<ul>
											<li>
												<a href="#users">UMS</a>
											</li>
											<li>
												<a href="#np">Newsletter Pro</a>
											</li>
										</ul>
										<?php include('ums_list_users.php'); ?>
										<?php include('ums_list_np.php'); ?>
									</div><!-- end of .tabs -->
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
