<style>
.error {
	border: 1px solid red;
}
</style>
<?php //print_r($shoppingcart) ?>
<form action="" method="post" class="uniform">
<div class="box-container">
	<div class="box-content">
		<div class="products">
			<div class="steps">
				<ul>
					<li class="step-1 active">
						<span class="steps-num">Step 1</span>
						<span class="title">Cover Fabric</span>		
						<span class="arrow"><img src="<?= base_url() ?>images/buttons/arrow.png" alt="arrow" width="25" height="14" /></span>	
					</li>
					<li class="step-2">
						<span class="steps-num">Step 2</span>
						<span class="title">Nail Heads/Fittings </span>		
													
					</li>
					<li class="step-3">
						<span class="steps-num">Step 3</span>
						<span class="title">Legs/Wood Finish </span>	
													
					</li>
					<li class="step-4">
						<span class="steps-num">Step 4</span>
						<span class="title">Checkout </span>		
													
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="steps-btn">
				<span class="prev"><a href="#">&lt;&lt; Previous Step</a></span>
				<span ><input type="submit" value="Next Step &gt;&gt;" name="next-btn" id="next-btn" class="next" /></span>
			</div>
			<div class="left-panel">
				<ul class="tabs">
					<li class="fabric-tab"><a href="#tab1">Fabrics</a></li>
					<li class="div"></li>
					<li class="leather-tab"><a href="#tab2">Leather</a></li>
					<li class="div"></li>
					<li class="model-tab"><a href="#tab3" style="font-size:13px; width:70px;">Model/Size</a></li>
					
				</ul>
				<div class="tab-container">
					<div id="tab1" class="tab-content">
						<div class="scroller">
							<div class="fabrics">
								<div class="filter">
										<label>Filter by:</label>
										<div class="select-fields">
											<select>
												<option>Select Pattern</option>
											</select>
											<select>
												<option>Select Color</option>
											</select>
											<select>
												<option>Select Color Inspiration</option>
											</select>
										</div>
									<div class="clear"></div>
								</div>
								<div class="listing">									
									<ul>
										<?php 
										foreach($fabrics as $f) {
										?>
											<li>
												<div class="banner"><a href="#"><img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][0]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="87" /></a></div>
												<span class="product-name"><a href="#"><?php echo $f['title'] ?></a></span>
												<span class="ref-num">No. #<?php echo $f['number'] ?></span>													
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
								<div class="filter">
										<label>Filter by:</label>
										<div class="select-fields">
											<select>
												<option>Select Pattern</option>
											</select>
											<select>
												<option>Select Color</option>
											</select>
											<select>
												<option>Select Color Inspiration</option>
											</select>
										</div>
									<div class="clear"></div>
								</div>
								<div class="listing">
									<ul>
										<?php 
										foreach($leathers as $f) {
										?>
										<li>
											<div class="banner"><a href="#"><img src="<?= base_url() ?>wpdata/images/<?php echo (count($f['images']) > 0 ? $f['images'][0]['id']."-l.jpg" : "") ?>" alt="banner" width="88" height="87" /></a></div>
											<span class="product-name"><a href="#"><?php echo $f['title'] ?></a></span>
											<span class="ref-num">No. #<?php echo $f['number'] ?></span>													
										</li>									
										<?php
										}
										?>				
										
									</ul>
								</div>
							</div>
						</div>
					</div>
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
				<h2 style="margin-top:-10px;margin-bottom:5px;">Bedhead and Base </h2>				
				<div style="line-height:20px;text-align:center;margin-left:80px;font-size:14px;padding-bottom:10px;">
					<div class="title" style="float:left;margin-right:20px;" id="category_label"></div>
					<div  class="title" style="float:left;margin-right:20px;" id="model_label" /></div>
					<div  class="title" style="float:left;margin-right:20px;" id="size_label" /></div>
				</div>
				<br style="clear:both"/>
				<div class="banner" style="margin-top:10px;"><img src="<?= base_url() ?>images/banners/products/details/image1.jpg" alt="banner" width="395" height="293" /></div>				
				<span class="zoom-btn" style="margin-top:20px"><a href="#">Click image to zoom</a></span>
				<div class="product-detail-btns">
					<span class="btns"><a href="#">Share</a></span>
					<span class="btns"><a href="#">Add to Favorite</a></span>
					<span class="btns"><a href="#">Add to Cart</a></span>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div><img src="<?= base_url() ?>images/b-curve.png" alt="bottom curve" width="972" height="11"c /></div>
</div>
</form>
<br /><br /><br /><br />

<script>

    $().ready(function () {	 
				
		$('#category').change(function (e) {
			if ($(this).val() != "")
				$('#category_label').html('Category :' + $(this).val());			
		});
		$('#model').change(function (e) {
			if ($(this).val() != "")
				$('#model_label').html('Model :' + $(this).val());			
		});
		$('#size').change(function (e) {
			if ($(this).val() != "")
				$('#size_label').html('Size :' + $(this).val());			
		});
		
						
		$('#category').val('<?php echo !isset($shoppingcart['category']) ? set_value('category',@$category) : $shoppingcart['category'] ?>').change();
		$('#model').val('<?php echo !isset($shoppingcart['model']) ? set_value('model',@$model) : $shoppingcart['model'] ?>').change();
		$('#size').val('<?php echo !isset($shoppingcart['size']) ? set_value('size',@$size) : $shoppingcart['size'] ?>').change();
			
		$('#next-btn').click(function (e) {		    
			
			error = '';
			error += validate('category', 'Category');
			if(error != ''){activate_tab('#tab3');}//activate tab#3
			error += validate('model', 'Model');
			if(error != ''){activate_tab('#tab3');}//activate tab#3
			error += validate('size', 'Size');
			if(error != ''){activate_tab('#tab3');}//activate tab#3							
			
			if (error != '')
			{				 
				$.floatingMessage(error, { height : 60, width:200,time:3000  });  
				return false;
			}
				//parent.location.href = '<?= base_url() ?>register/step2';

        });

        function activate_tab(tab_id)
        {
        	$("ul.tabs li").removeClass("active"); //Remove any "active" class
        	$('li.model-tab').addClass("active"); //Add "active" class to model tab
        	$(".tab-content").hide(); //Hide all content
        	$(tab_id).fadeIn(); //Fade in the active content
        }
	});
</script>