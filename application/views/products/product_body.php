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

.listing div.banner {
	border: 3px solid #f2f2f2;
	border-radius: 6px;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;	
}
div.selected-option { 
	border: 3px solid #ff6600 !important;
	border-radius: 6px;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
}
div.listing ul li span.product-name {
	text-align: center !important;
	display: block;
	float: none;
}
</style>
<? 
		$current_product_step = trim(str_replace("/products/", "", $_SERVER['REQUEST_URI'])); 
		$varbaseurl = "http://www.twistlifestyle.com";
		$varbaseurl = base_url();
		/**
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
		**/ 
		switch($current_product_step)
		{
			case 'nail_fittings':
				$varprodstep = 2;
				$varstep1active = ""; 
				$varstep2active = "class='step-active'";
				$varstep3active = "";
				$varprevlink = "<span class='prev'><a href='{$varbaseurl}products/'>&lt;&lt; Previous Step</a></span>";
				break;
			case 'wood_fittings':
				$varprodstep = 3;
				$varstep1active = ""; 
				$varstep2active = ""; 
				$varstep3active = "class='step-active'";
				$varprevlink = "<span class='prev'><a href='{$varbaseurl}products/nail_fittings'>&lt;&lt; Previous Step</a></span>";
				break;
			default:
				$varprodstep = 1; 
				$current_product_step = "";
				$varstep1active = "class='step-active'";
				$varstep2active = ""; 
				$varstep3active = "";
				$varprevlink = "<span class='prev'><a href='#'>&lt;&lt; Previous Step</a></span>";	
		}
		?>
		<div class='steps' id='steps'>
			<img src='/img/step-<?php echo $varprodstep;?>.gif' />
			<span id='step1' <?php echo $varstep1active;?>>
				<?php echo (!empty($current_model['step1_text']))?$current_model['step1_text']:'Cover Fabric';?>
			</span>
			<span id='step2' <?php echo $varstep2active;?>>
				<?php echo (!empty($current_model['step1_text']))?$current_model['step2_text']:'Nail Heads/Fittings';?>
			</span>
			<span id='step3' <?php echo $varstep3active;?>>
				<?php echo (!empty($current_model['step1_text']))?$current_model['step3_text']:'Legs/Wood Finish';?>
			</span>
			<span id='step4'>Checkout</span>
			<div class='clear'></div>
		</div>
		<div class='steps-btn1'>
				<?php echo $varprevlink;?>
				<span>
				<input type='submit' value='Next Step &gt;&gt;' name='next-btn1' id='next-btn1' class='next' />
				</span>
			</div>
		
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
								<input type="hidden" name="fabric" value="<?php echo $fabric;?>" id="product-fabric"/>									
									<ul>
										<?php
										$selection_option = '';
										foreach($fabrics as $f) {
											if($fabric == $f['type_id'])
											{
												$selection_option = ' selected-option';	
											}
										?>
											<li>
												<div class="banner<?php echo $selection_option;?>" style="height:146px;overflow:hidden;text-align:center;">
												<a href="#product-fabric" class="product-option" rel="<?php echo $f['type_id'];?>">
													<img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][0]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="73" />
													<?php if(!empty($f['images'][1]['id'])) {?>
														<img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][1]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="73" />
													<?php } else { ?>
														<img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][0]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="73" />
													<?php }?>
												</a>
												</div>
												<span class="product-name"><a href="#"><?php echo $f['title'] ?></a></span>
											</li>											
										<?php
											$selection_option = '';
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
								<input type="hidden" name="leather" value="<?php echo $leather;?>" id="product-leather" />
									<ul>
										<?php
										$selection_option = '';
										foreach($leathers as $f) {
											if($leather == $f['type_id'])
											{
												$selection_option = ' selected-option';	
											}
										?>
										<li>
											<a href="#product-leather" class="product-option" rel="<?php echo $f['type_id'];?>">
												<div class="banner<?php echo $selection_option;?>" style="text-align:center;"><img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][0]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="87" /></a></div>
												<span class="product-name"><?php echo $f['title'] ?></span>
											</a>
										</li>									
										<?php
											$selection_option = '';
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
								<input type="hidden" name="nail" value="<?php echo $nail;?>" id="product-nail" />
									<ul>
										<?php
										$selection_option = '';
										foreach($nails as $f) {
											if($nail == $f['type_id'])
											{
												$selection_option = ' selected-option';	
											}
										?>
											<li>
												<a href="#product-nail" class="product-option" rel="<?php echo $f['type_id'];?>">
													<div class="banner<?php echo $selection_option;?>" style="text-align:center;"><img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][0]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="87" /></a></div>
													<span class="product-name"><?php echo $f['title'] ?></span>
												</a>
											</li>											
										<?php
											$selection_option = '';
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
								<input type="hidden" name="leg" value="<?php echo $leg;?>" id="product-leg"/>
									<ul>
										<?php
										$selection_option = '';
										foreach($legs as $f) {
											if($leg == $f['type_id'])
											{
												$selection_option = ' selected-option';	
											}
										?>
											<li>
												<a href="#product-leg" class="product-option" rel="<?php echo $f['type_id'];?>">
													<div class="banner<?php echo $selection_option;?>" style="text-align:center;"><img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][0]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="87" /></a></div>
													<span class="product-name"><?php echo $f['title'] ?></span>
												</a>
											</li>											
										<?php
											$selection_option = '';
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
													<option value="<?php echo $s['title'] ?>" <?php if($category == $s['title']) echo 'selected="selected"';?>><?php echo $s['title'] ?></option>
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
													<option value="<?php echo $s['title'] ?>" <?php if($model == $s['title']) echo 'selected="selected"';?>><?php echo $s['title'] ?></option>
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
													<option value="<?php echo $s['title'] ?>" <?php if($category==$s['title']) echo 'selected';?>><?php echo $s['title'] ?></option>
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
				<div class="banner" style="margin-top:8px;">
					<?php if(!empty($current_model_image[0]['title'])) {?>
						<div style="overflow:hidden;width:395px;height:293px;margin:0;padding:0;">
						<?php echo img(array(
								'src' => 'wpdata/images/'.$current_model_image[0]['id'].'-l.jpg',
								'width' => '100%'
							)
						);
						?>
						</div>
					<?php } else { ?>
						<img src="<?= base_url() ?>images/banners/products/details/image1.jpg" alt="banner" width="395" height="293" />
					<?php }?>
				</div>				
				<span class="zoom-btn" style="margin-top:17px"><a href="#">Click image to zoom</a></span>
                <div id="options-bar">
                	<a href="" class="options">Share</a>
                    <a href="" class="options">Add to Favorite</a>
                    <a href="" class="options">Add to Cart</a>
                </div> <!-- End options -->
			</div>
			<div class="clear"></div>
			
<script type="text/javascript" defer="defer">
	(function(){
		$('.product-option').click(function(){
			selection = $(this);
			target = selection.attr('href');
			value = selection.attr('rel');
			$(target).val(value);
			lis = selection.parent().parent().parent().find('li > div').removeClass('selected-option');
			selection.parent().addClass('selected-option');
		});
	})();
</script>