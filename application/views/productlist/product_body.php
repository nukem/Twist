<style>
.error {
	border: 1px solid red;
}
#steps	{
	position: relative;
}
#steps span	{
	color: #CECECE;
	display: block;
	font: bold 14px 'Droid Sans', Arial, Helvetica, sans-serif;
	height: 18px;
	position: absolute;
	overflow: hidden;
	top: 43px;
	text-align: center;
	width: 157px;
}
#steps .step-active	{ color: #222; }
#steps #step1	{ left: 135px; }
#steps #step2	{ left: 310px; }
#steps #step3	{ left: 480px; }
#steps #step4	{ left: 660px; }
</style>
<? 
		$current_product_step = trim(str_replace("/products/", "", $_SERVER['REQUEST_URI'])); 
		$varbaseurl = "http://www.twistlifestyle.com";
		if ($current_product_step == "" or $current_product_step == "/products"):
			$varprodstep = 1; $current_product_step = "";
			$varstep1active = "class='step-active'"; $varstep2active = ""; $varstep3active = "";
			$varprevlink = "<span class='prev'><a href='#'>&lt;&lt; Previous Step</a></span>";
		elseif ($current_product_step == "nail_fittings"):
			$varprodstep = 2;
			$varstep1active = ""; $varstep2active = "class='step-active'"; $varstep3active = "";
			$varprevlink = "<span class='prev'><a href='$varbaseurl/products/'>&lt;&lt; Previous Step</a></span>";
		elseif ($current_product_step == "wood_fittings"):
			$varprodstep = 3;
			$varstep1active = ""; $varstep2active = ""; $varstep3active = "class='step-active'";
			$varprevlink = "<span class='prev'><a href='$varbaseurl/products/nail_fittings'>&lt;&lt; Previous Step</a></span>";
		endif;
		echo "
		<div class='steps' id='steps'>
			<img src='/img/step-$varprodstep.gif' />
			<span id='step1' $varstep1active>Cover Fabric</span>
			<span id='step2' $varstep2active>Nail Heads/Fittings</span>
			<span id='step3' $varstep3active>Legs/Wood Finish</span>
			<span id='step4'>Checkout</span>
			<div class='clear'></div>
		</div>
		<div class='steps-btn1'>
				$varprevlink
				<span>
				<input type='submit' value='Next Step &gt;&gt;' name='next-btn1' id='next-btn1' class='next' />
				</span>
			</div>
		";
		?>			
			<div class="left-panel">
				<ul class="tabs">
					<? if ($current_product_step == ""): ?>
						<li class="fabric-tab"><a href="#tab1">Fabrics</a></li><li class="div"></li>
						<li class="leather-tab"><a href="#tab2">Leather</a></li><li class="div"></li>
					<? elseif ($current_product_step == "nail_fittings"): ?>
						<li class="tab1"><a href="#tab1">Nail Heads</a></li><li class="div"></li>
					<? elseif ($current_product_step == "wood_fittings"): ?>
						<li class="tab1"><a href="#tab1">Legs/Finish</a></li><li class="div"></li>
					<? endif; ?>
					<li class="model-tab"><a href="#tab3" style="font-size:13px; width:70px;">Model/Size</a></li>
				</ul>
				<div class="tab-container">
					<? if ($current_product_step == ""): ?>
					<div id="tab1" class="tab-content">
						<div class="scroller">
							<div class="fabrics">
									<span>
									<br>Please select your fabric be clicking on your desired swatch panel below:
									</span>
								<div class="listing">									
									<ul>
										<?php 
										foreach($fabrics as $f) {
										?>
											<li>
												<div class="banner"><a href="#"><img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][0]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="87" /></a></div>
												<span class="product-name"><a href="#"><?php echo $f['title'] ?></a></span>
											</li>											
										<?php
										}
										?>										
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div id="tab2" class="tab-content">
						<div class="scroller">
							<div class="fabrics">
								<span>
								<br>Please select your leather be clicking on your desired swatch panel below:
								</span>
								<div class="listing">
									<ul>
										<?php 
										foreach($leathers as $f) {
										?>
										<li>
											<div class="banner"><a href="#"><img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][0]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="87" /></a></div>
											<span class="product-name"><a href="#"><?php echo $f['title'] ?></a></span>
										</li>									
										<?php
										}
										?>				
										
									</ul>
								</div>
							</div>
						</div>
					</div>
					<? endif; ?>
					<? if ($current_product_step == "nail_fittings"): ?>
					<div id="tab1" class="tab-content">
						<div class="scroller">
							<div class="fabrics">
								<span>
								<br>Please select your nail preference be clicking on your desired swatch panel below:
								</span>
								<div class="listing">
									<ul>
										<?php 
										foreach($nails as $f) {
										?>
											<li>
												<div class="banner"><a href="#"><img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][0]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="87" /></a></div>
												<span class="product-name"><a href="#"><?php echo $f['title'] ?></a></span>
											</li>											
										<?php
										}
										?>														
									</ul>
								</div>
							</div>
						</div>
					</div>
					<? endif; ?>
					<? if ($current_product_step == "wood_fittings"): ?>
					<div id="tab1" class="tab-content">
						<div class="scroller">
							<div class="fabrics">
									<span>
									<br>Please select your wood finish:
									</span>
								<div class="listing">
									<ul>
										<?php 
										foreach($legs as $f) {
										?>
											<li>
												<div class="banner"><a href="#"><img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][0]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="87" /></a></div>
												<span class="product-name"><a href="#"><?php echo $f['title'] ?></a></span>
											</li>											
										<?php
										}
										?>				
									</ul>
								</div>
							</div>
						</div>
					</div>
					<? endif; ?>
					<div id="tab3" class="tab-content">
						<div class="scroller">
							<div class="fabrics">
								<div class="filter">
										<label>Category :</label>
										<div class="select-fields">
											<select id="category" name="category">				
												<option value="">Select Category</option>
												<?php 
												foreach($categories as $s) {
												?>
													<option value="<?php echo $s['title'] ?>"><?php echo $s['title'] ?></option>
												<?php
												}
												?>
											</select>
										</div>
										<div class="clear"></div><br/>
										<label>Models :</label>
										<div class="select-fields">
											<select  id="model" name="model" onchange="fetch_model_details(this);">
												<option value="">Select Models</option>
												<?php 
												foreach($models as $s) {
												?>
													<option value="<?php echo $s['title'] ?>"><?php echo $s['title'] ?></option>
												<?php
												}
												?>
											</select>
										</div>
										<br style="clear:both" /><br/>
										<label>Size :</label>
										<div class="select-fields">
											<select id="size" name="size">
												<option value="">Select Size</option>
												<?php 
												foreach($sizes as $s) {
												?>
													<option value="<?php echo $s['title'] ?>"	><?php echo $s['title'] ?></option>
												<?php
												}
												?>
											</select>											
										</div>
										<br style="clear:both" /><br/>
										<div id="option-text-container"></div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>				
				</div>
			</div>
			<div class="product-detail">
				<h2 style="margin-top:-10px;margin-bottom:5px;">
				<span id="model_label" /></span>
				<span id="size_label" /></span>
				Bedhead & Base 
				</h2>
				<div style="line-height:17px;text-align:center;margin-left:80px;font-size:14px;padding-bottom:7px;">
					<div  class="title" style="float:left;margin-right:20px;" id="size_label" /></div>
				</div>
				<br style="clear:both"/>
				<div class="banner" style="margin-top:8px;"><img src="<?= base_url() ?>images/banners/products/details/image1.jpg" alt="banner" width="395" height="293" /></div>				
				<span class="zoom-btn" style="margin-top:17px"><a href="#">Click image to zoom</a></span>
                <div id="options-bar">
                	<a href="" class="options">Share</a>
                    <a href="" class="options">Add to Favorite</a>
                    <a href="" class="options">Add to Cart</a>
                </div> <!-- End options -->
			</div>
			<div class="clear"></div>
