<? require ("tpl/inc/head.php"); ?>
<body> 
	<div id="page"> 
		<? require ("tpl/inc/header.php"); ?> 
		<? require ("tpl/inc/path.php"); ?> 
		<div id="content"> 
			<div id="left-col"> 
				<div id="left-col-border"> 
					<? if (isset ($errors)) require ("tpl/inc/error.php"); ?> 
					<? if (isset ($messages)) require ("tpl/inc/message.php"); ?> 
					<? if (isset ($_SESSION['epClipboard'])) require ("tpl/inc/clipboard.php"); ?> 
					<? require ("tpl/inc/structure.php"); ?> 
				</div> 
			</div> 
			<div id="right-col"> 
				<h2 class="bar green"><span><?= $lang[58] ?></span></h2> 
				<form action=".?id=<?= $id ?>" method="post" enctype="multipart/form-data" > 
					<? require ("tpl/inc/buttons.php"); ?> 
					<div class="right-col-padding1"> 
						<div class="width-99pct"> 
							<table class="rec-table"> 
								<? require ("tpl/inc/record.php"); ?> 

								<tr>
									<td colspan="4">
										Add your social media links to your web site. Just copy + paste the links to your
										pages into the fields below and they'll automatically be added to the web site.
									</td>
								</tr>
								<tr> 
									<td>
										<label>FaceBook</label>
										<input type="text" name="facebook" value="<?php echo show_value('facebook'); ?>" class="textfield width-100pct" />
									</td>
									<td>
										<label>Twitter</label>
										<input type="text" name="twitter" value="<?php echo show_value('twitter'); ?>" class="textfield width-100pct" />
									</td>
									<td>
										<label>YouTube</label>
										<input type="text" name="youtube" value="<?php echo show_value('youtube'); ?>" class="textfield width-100pct" />
									</td>
									<td>
										<label>Linked In</label>
										<input type="text" name="linkedin" value="<?php echo show_value('linkedin'); ?>" class="textfield width-100pct" />
									</td>
									</tr>
									<? require ("tpl/inc/rights.php"); ?> 
								</table>

							</div> 
						</div> 
					</form> 
				</div> 
				<? require ("tpl/inc/footer.php"); ?> 
			</div> 
		</div> 
	</body>
</html>
