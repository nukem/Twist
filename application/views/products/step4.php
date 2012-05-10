<style>
/** view cart **/
	table.shoppingcart { width: 99%; }
		table.shoppingcart thead th { background-color: #eaeaea; text-align: left; font-weight: normal; padding: 5px 8px; }
		table.shoppingcart tr td { padding: 12px 8px; vertical-align: top; border-bottom: 1px solid #eaeaea; text-align: left; font-size: 14px; }
		table.shoppingcart tr td.money { text-align: right; color: #2f1e0f; font-weight: bold; }
		table.shoppingcart tr td.error { text-align: right; color: #cc0000; font-weight: bold; }
			table.shoppingcart tr td.money input { text-align: right; color: #2f1e0f; font-weight: bold; width: 30px; }
			table.shoppingcart tr td.money a.cbtn { margin: 5px 0 5px auto; }

	.cartthumb, .cartfabric { float: left; margin: 0 5px; }
		.cartthumb img { width: 160px; }
	.cartfabric { width: 70px; height: 70px; padding: 11px 12px; background:url(/img/cart/fabricframe.gif) no-repeat; }
		.cartfabric a, .cartfabric a:link, .cartfabric a:visited { display: block; width: 70px; height: 70px; overflow: hidden; }
	.cartdesc { clear: left; font-size: 12px; }
	.cartfabdesc { margin-left: 130px; font-size: 12px; padding: 8px 0; }
		.cartdesc h5, .cartdesc em, .cartfabdesc h5, .cartfabdesc em { font-style: normal; color: #2f1e0f; }
		.cartdesc h5, .cartfabdesc h5 { margin: 0 0 -5px 0; font-size: 14px; }
		.cartdesc p { margin: 0; }
		.cartfabdesc p { margin-top: 0; }

	.totals { width: 240px; float: right; padding: 2px 8px; font-weight: bold; }
		.totals label { width: 110px; float: left; clear: both; text-align: left; color: #6c6c6c; font-size: 14px; margin-top: 4px; }
		.totals span { width: 110px; float: right; text-align: right; color: #2f1e0f; font-size: 14px; margin-top: 4px; }
			.totals label big, .titals span big { font-size: 18px; }
		.totals .hr { margin: 4px 0 0 0; clear: left; }


.error {
	border: 1px solid red;
}
.previous:visited {
	color: #222;
}
.previous {
	background: url(/img/buttons-bg2b.gif);
}
.previous:hover {
	text-decoration:none;
}
.next {
	background: url(/img/buttons-bg2.gif);
}
.previous,
.next {
	border: none;
	
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	color: #222;
	display: block;
	font: bold 14px 'Droid Sans', Arial, Helvetica, sans-serif;
	line-height: 30px;
	text-align: center;
	text-decoration: none;
	width: 146px;
	height: 27px;	
}
.next {
	float: right;
}
.step-container {
	width: 890px;
	overflow: hidden;
	margin: 0 0 13px 0;
}
.previous span,
.next span {
	font-size: 17px;
}

.options	{
	background: url(/img/buttons-bg.gif) no-repeat;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	display: inline-block;
	font: bold 13px 'Droid Sans', Arial, Helvetica, sans-serif;
	line-height: 30px;
	margin-left: 4px;
	text-decoration: none;
	vertical-align: middle;
	width: 144px;
	height: 30px;
	text-align: center;
	margin-top: 6px;
}
.lt-ie8 .options	{ display: inline; margin-top: 6px; }
.options:link,
.options:visited	{ color: #222; }
.options:hover	{ text-decoration: underline; }

#options-bar	{
	background-color: #D2D2D2;
	border-radius: 7px;
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px; line-height: 40px;
	margin-top: 10px;
	width: 475px;
	height: 43px;	
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

.product-options-container {
	float: right;
}
.product-options-container > ul {
	float: left;
}
.product-options-container > ul li:first {
	display: block;
}
.product-options-container > ul > li {
	display: inline-block;
	margin-top: 4px;
	width: 72px;
	margin-right: 12px;
	vertical-align: top;
}
.product-options-container > ul > li > span{
	overflow:hidden;
	height: 47px;
	width: 47px;
}
.product-options-container > ul > li span img {
	width: 100%;
}
.product-options-container > ul > li p {
	font-size: 10px;
	text-align: center;
	font-family: verdana, sans-serif;
	margin:0;
	line-height: 1.1em;
}

.dropdown-selector-container {
	background-color: white;
	border: 1px solid #CCC;
	border: 1px solid rgba(0, 0, 0, 0.2);
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;	
	position: relative;
	padding: 2px 15px 4px 4px;
	background-color: #EFEFEF;
}
.dropdown-selector-container > p {
	padding: 0;
	line-height: 1.4em;
	margin: 0px 0px 2px 0px;
}
.dropdown-toggle {
	position: absolute;
	top: 32%;
	right: 2px;
	width: 12px;

}
.dropdown {
	z-index: 5;
	position: absolute;
	width: 200px;
	border: 1px solid #333;
	display: none;
	padding: 4px;
	background-color: #FFF;
list-style: none;
background-color: white;
border: 1px solid #CCC;
border: 1px solid rgba(0, 0, 0, 0.2);
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
-webkit-background-clip: padding-box;
-moz-background-clip: padding;
background-clip: padding-box;
	top: 110%;
}
.dropdown > li {
	display: inline-block;
	width: 60px;
	height: 86px;
	
	padding: 0;
	margin: 0px 4px 6px 0px;
	vertical-align: top;
}
.dropdown > li.group-title {
	display: block;
	font-weight: bold;
	margin: 4px 0px 0px 0px;
	padding: 0;
	height: 1.3em;
	line-height: 1.3em;
}

.dropdown > li > p {
	margin: 0;
	padding:0;
	line-height: 1em;
}
.dropdown > li > a {
	border: 1px solid #EEE;
	display: block;
	padding: 0;
	margin: 0;
}
.dropdown > li img{
	height: 100%;
	width: 100%;
}

.product-options-container {
	float: none;
}

.product-options-container > ul {
	float: none;
	position: relative;
}
.product-options-container > ul > li p {
	padding: 0;
	margin-bottom: 2px;
}

</style>
<div class="box-container">
	<div class="box-content">
		<div class="products" >
			<div class="steps" id="steps">
				<img src="/img/step-4.gif" />
				<span id="step1">Cover Fabric</span>
	            <span id="step2">Nail Heads/Fittings</span>
	            <span id="step3">Legs/Wood Finish</span>
	            <span id="step4" class="step-active">Checkout</span>
			<div class="clear"></div>
			</div>
			<div class="step-container">
				<button class="next">Next Step <span>»</span></button>
				<a href="<?=base_url()?>products/wood_fittings" class="previous"><span>«</span> Previous Step</a>

				
			</div>
			<div class="left-panel" style="width:0px;background:white">
				
			</div>
			<div class="product-detail1" style="float:left;width:850px;">										
				<table class="shoppingcart" cellspacing="0" cellpadding="0" border="0" style="border:0px solid black">
				<form action="" method="post" class="uniform">
				<thead>
					<thead>
					<tr>
						<th >Suggested Items</th>
						<th style="text-align:left;width:146px;">&nbsp;</th>
						<th style="text-align:left">&nbsp;</th>						
						<th style="text-align:right">Unit</th>
						<th style="text-align:right">Qty.</th>
						<th style="text-align:right">Price</th>
					</tr>		
				</thead>
				</thead>
				<tbody>					
					<tr>
						<td style="width:420px">						
							<div class="cartfabric"><a><img src="<?= base_url() ?>images/banners/products/905501.jpg" alt="Lotus" height="50px;" /></a></div>							
							<div>
								<h5># 53533 - Manchester Sheets</h5>
								<p>Cover: <em>Color #183933</em></p>							
							</div>
						</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td class="money">$215.00<input type="hidden" name="price[4372]" value="215.00" /></td>
						<td class="money"><select>
										<option>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
										<option>6</option><option>8</option><option>8</option><option>9</option><option>10</option>
										</select>
						</td>
						<td class="money">$<span>215.00</span><br /><br />
							
						</td>
					</tr>					
				</tbody>
				</table>
				
				<br/>
				<h3>Checkout Items</h3>
				<table class="shoppingcart" cellspacing="0" cellpadding="0" border="0">
				<thead>
					<tr>
						<th >Item Description</th>
						<th style="text-align:left">Model</th>
						<th style="text-align:left">Size</th>
						<th style="text-align:right">Unit</th>
						<th style="text-align:right">Qty.</th>
						<th style="text-align:right">Price</th>
					</tr>		
				</thead>
				<tbody>
					<?php 
					$total = 0;
					foreach($shoppingcart_all as $s) {
					$total = $total + $s['price'];

					?>
					<tr >													
							<td style="width:200px" rowspan="2">
								<div class="cartthumb">
									<?php echo img('wpdata/images/'.$s['Model'][0]['images'][0]['id'].'-s.jpg');?>
								</div>
								
								<div class="cartdesc"><br/>
									<h5><?php echo $s['model'] . ' ' . $s['size']?> Size Bed</h5><br/>
									
								</div>
							</td>
							<td>
											<select  id="model_<?php echo $s['id'];?>" name="model" onchange="update_cart_item(<?php echo $s['id'];?>);">
												<?php 
												foreach($models as $model) {
													$selected = ($s['model'] == $model['title'])?' selected="selected"':'';
												?>
													<option <?php echo $selected;?> value="<?php echo $model['title'] ?>"><?php echo $model['title'] ?></option>
												<?php
												}
												?>
											</select>
							</td><td>	
											<select  id="size_<?php echo $s['id'];?>" name="size" onchange="update_cart_item(<?php echo $s['id'];?>);">
												<?php 
												foreach($sizes as $size) {
													$selected = ($s['size'] == $size['title'])?' selected="selected"':'';
												?>
													<option <?php echo $selected;?> value="<?php echo $size['title'] ?>"><?php echo $size['title'] ?></option>
												<?php
												}
												?>
											</select>										
							</td>
							<td class="money">$<?php echo number_format($s['price'], 2, '.', ' ') ?><input type="hidden" name="price[4372]" value="<?php echo number_format($s['price'], 2, '.', ' ') ?>" /></td>
							<td class="money">
								<select>
											<option>0</option><option selected>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
											<option>6</option><option>8</option><option>8</option><option>9</option><option>10</option>
											</select>
							</td>
							<td class="money" rowspan="2">$<span><?php echo number_format($s['price'], 2, '.', ' ') ?></span><br /><br />
								
								<a href="?remove=<?php echo $s['id'] ?>" class="remove-cart-item" title="Remove Item">&nbsp;</a>
							</td>
						</tr>
						
						<tr>
							<td colspan="4" style="vertical-align:top;">
								
								<div class="option-container">
									<div class="product-options-container">
									
										<ul>
											<li style="width: 98px; height:90px; ">
												
											<?php 
												if(!empty($s['Fabric']))
												{
													$vartag = 'Fabric';
												} else {
													$vartag = 'Leather';
												}
												
											?>
												<div class="dropdown-selector-container">
												<p><?php echo $vartag?></p>
											<?php 
											 	if(!empty($s['Fabric'])):
														echo '<div class="cartfabric" style="overflow:hidden;padding:0;" id="cover-image-'.$s['id'].'" >';
														$vartag = "Fabric";
														if(count($s['Fabric']['0']['images']) > 1):
															echo "<div style='height:50%'>";
															echo img('wpdata/images/'.$s['Fabric']['0']['images'][0]['id'].'-s.jpg');
															echo "</div>";
															echo "<div style='height:50%;'>";
															echo img('wpdata/images/'.$s['Fabric']['0']['images'][1]['id'].'-s.jpg');
															echo "</div>";
														else:
															echo "<div style='height:50%'>";
															echo img('wpdata/images/'.$s['Fabric']['0']['images'][0]['id'].'-s.jpg');
															echo "</div>";
															echo "<div style='height:50%;'>";
															echo img('wpdata/images/'.$s['Fabric']['0']['images'][0]['id'].'-s.jpg');
															echo "</div>";
														endif;
														$fabric_title = $s['Fabric'][0]['title'];
													elseif(!empty($s['Leather'])):
														echo '<div class="cartfabric" style="overflow:hidden;padding:0;" id="cover-image-'.$s['id'].'" >';
														echo img('wpdata/images/'.$s['Leather'][0]['images'][0]['id'].'-s.jpg');
														$vartag = "Leather";
														$fabric_title = $s['Leather'][0]['title'];
												 	endif;
												 ?>
												
												</div>
												<p id='cover-title-<?php echo $s['id'];?>'><?php echo $fabric_title;?></p>
												<a href="#" class="dropdown-toggle"><span class="icon-chevron-down"></span></a>
												<ul class="dropdown" style="display:none;">
													<li class="group-title">Fabrics</li>
												<?php foreach($s['Fabrics_related'] as $fabric):?>
														<li>
															
															<div style="overflow:hidden;padding:0;height:70px;" >
															<a href="#cover-image-<?php echo $s['id'];?>" class="product-option-selector" rel="fabric" id="<?php echo $fabric['type_id'];?>"  itemid="<?php echo $s['id'];?>">
															<?php 
																if(!empty($fabric['images'][1]['id'])) 
																{
																	echo "<div style='height:50%'>";
																	echo img('wpdata/images/'.$fabric['images'][0]['id'].'-s.jpg');
																	echo "</div>";
																	echo "<div style='height:50%'>";
																	echo img('wpdata/images/'.$fabric['images'][1]['id'].'-s.jpg');
																	echo "</div>";
																} else {
																	echo "<div style='height:50%'>";
																	echo img('wpdata/images/'.$fabric['images'][0]['id'].'-s.jpg');
																	echo "</div>";
																	echo "<div style='height:50%'>";
																	echo img('wpdata/images/'.$fabric['images'][0]['id'].'-s.jpg');
																	echo "</div>";
																}
															?>
															</a>
															</div>
														
															<p class="options-title"><?php echo $fabric['title'];?></p>
														</li>
												<?php endforeach;?>
														<li class="group-title">Leathers</li>
												<?php foreach($s['Leathers_related'] as $leather):?>
														<li>
															<div style="overflow:hidden;padding:0;height:70px;" >
															<a href="#cover-image-<?php echo $s['id'];?>" class="product-option-selector" rel="leather" id="<?php echo $leather['type_id'];?>" itemid="<?php echo $s['id'];?>">
															<?php echo img('wpdata/images/'.$leather['images'][0]['id'].'-s.jpg');?>
															</a>
															</div>
															<p class="options-title"><?php echo $leather['title'];?></p>
														</li>
												<?php endforeach;?>
													</ul>
												</div>
											</li>
											<li>
												<div class="dropdown-selector-container">
													<p>Nails</p>
													<span>
													<?php 
														echo img(array(
																		'src' => 'wpdata/images/'.$s['Nail'][0]['images'][0]['id'].'-s.jpg',
																		'id' => 'nail-image-'.$s['id']
																	)
																);
													?>
													</span>
													<p id="nail-option-title-<?php echo $s['id'];?>"><?php echo $s['Nail'][0]['title'];?></p>
													<a href="#" class="dropdown-toggle"><span class="icon-chevron-down"></span></a>
													<ul class="dropdown" style="display:none;">
														<?php foreach($s['Nails_related'] as $nail):?>
														<li>
															<div style="height:60px; width:60px;">
															<a href="#nail-image-<?php echo $s['id'];?>" class="product-option-selector" rel="nail" id="<?php echo $nail['type_id'];?>" itemid="<?php echo $s['id'];?>">
															<?php echo img('wpdata/images/'.$nail['images'][0]['id'].'-s.jpg');?>
															</a>
															</div>
															<p class="options-title"><?php echo $nail['title'];?></p>
														</li>
														<?php endforeach;?>
														
													</ul>
												</div>
											</li>
											<li>
												<div class="dropdown-selector-container">
													<p>Legs</p>
													<span>
													<?php 
														echo img(array(
																	'src' => 'wpdata/images/'.$s['Legs'][0]['images'][0]['id'].'-s.jpg',
																	'id' => 'leg-image-'.$s['id']
																	)
																);
													?>
													</span>
													<p id="leg-option-title-<?php echo $s['id'];?>"><?php echo $s['Legs'][0]['title'];?></p>
													<a href="#" class="dropdown-toggle"><span class="icon-chevron-down"></span></a>
													<ul class="dropdown">
														<?php foreach($s['Legs_related'] as $leg):?>
														<li>
															<div style="height:60px">
															<a href="#leg-image-<?php echo $s['id'];?>" class="product-option-selector" rel="leg" id="<?php echo $leg['type_id'];?>" itemid="<?php echo $s['id'];?>">
															<?php echo img('wpdata/images/'.$leg['images'][0]['id'].'-s.jpg');?>
															</a>
															</div>
															<p class="options-title" id="legs-option-title-<?php echo $s['id'];?>"><?php echo $leg['title'];?></p>
														</li>
														<?php endforeach;?>
														
													</ul>
												</div>
											</li>
										</ul>
									</div>
								</div>
								
								
								
							</td>
						</tr>
					<?php
						}
						?>
				</tbody>
				</table>
				<div class="totals">
					<label>Subtotal:</label>
					<span id="cart_subtotal">$<?php echo  number_format($total, 2, '.', ' ') ?></span>					
					<label>Shipping:</label>
					<span id="cart_shipping">100.00</span>
					<?php 
						$tax = $total * 0.1; 						
					?>
					<label>GST (10%) :</label>
					<span id="cart_shipping">$<?php echo number_format($tax, 2, '.', ' ') ?></span>

					<label><big>Grand&nbsp;Total:</big></label>
					<span><big id="cart_total">$<?php echo  number_format($total+100+$tax, 2, '.', ' ') ?></big></span>
				</div>
				</form>
				<div class="clear"></div><br/>
				<div id="options-bar" style="text-align:right;width:840px;height:55px;padding-right:12px;padding-top:8px;padding-bottom:0px;">
					<?php echo anchor('products/billing_shipping_info', 'Checkout', 'class="options"');?>
				</div>		
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear" style="height:10px;"></div>
	</div>	
	<div><img src="<?= base_url() ?>images/b-curve.png" alt="bottom curve" width="972" height="11"c /></div>
</div>
<br /><br /><br /><br />

<script type="text/javascript" defer="defer">
var base_url = '<?php echo base_url();?>';

function update_cart_item(id)
{
	size = $("#size_"+id).val();
	model = $("#model_"+id).val();
	jQuery.ajax({
		url: base_url + 'products/update_cart_item',
		type: "POST",
		data: 'size='+size+'&model='+model+'&id='+id
	}).done(function(data){
		//console.log(data);
	});
}

(function(){
	$('.dropdown-toggle').click(function(){
		$current = $(this).parent().children('.dropdown');
		$('.dropdown').not($current).hide();
		$current.toggle();
		
		return false;
	});

	$('.product-option-selector').click(function(){
		$selector = $(this);
		//console.log($selector);
		images = $selector.find('img');
		target = $selector.attr('href');

		type_id = $selector.attr('id');
		type = $selector.attr('rel');
		shop_order_item_id = $selector.attr('itemid');

		new_title = $selector.parent().parent().find('p.options-title').text();

		jQuery.ajax({
			url: base_url + 'products/update_cart_item',
			type: 'POST',
			data: 'id='+shop_order_item_id+'&'+type+'='+type_id
		}).done(function(data){
			
		}); 
		console.log(type_id);
		console.log(type);
		console.log(shop_order_item_id);
		
		console.log(images.length);
		console.log(target);
		console.log(images);

		//place the new title
		if (type == 'fabric' || type == 'leather')
		{
			console.log('fabric or leather title');
			$('#cover-title-' + shop_order_item_id).text(new_title);
		} else {
			console.log('others title');
			$('#' + type + '-option-title-' + shop_order_item_id).text(new_title);
		}
		
		//swap the image
		if (images.length == 1)
		{
			$(target).attr('src', images.attr('src'));
		}
		if (images.length == 2)
		{
			target_images = $(target).find('img');
			$(target_images[0]).attr('src', $(images[0]).attr('src'));
			$(target_images[1]).attr('src', $(images[1]).attr('src'));
			$('#cover-title').html('Fabric');
		}
		//special case for leather
		if(type == 'leather')
		{
			target_images = $(target).find('img');
			$(target_images[0]).attr('src', $(images[0]).attr('src'));
			$(target_images[1]).attr('src', $(images[0]).attr('src'));
			$('#cover-title').html('Leather');
		}
		$('.dropdown').hide();
		return false;
	});

	$('body').click(function(){
		$('.dropdown').hide();
	});
})();

</script>