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


</style>
<form action="" method="post" class="uniform">
<div class="box-container">
	<div class="box-content">
		<div class="products" >
			<div class="steps">
				<ul>
					<li class="step-1 ">
						<span class="steps-num">Step 1</span>
						<span class="title">Cover Fabric</span>								
					</li>
					<li class="step-2">
						<span class="steps-num">Step 2</span>
						<span class="title">Nail Heads/Fittings </span>		
													
					</li>
					<li class="step-3">
						<span class="steps-num">Step 3</span>
						<span class="title">Legs/Wood Finish </span>	
													
					</li>
					<li class="step-4 active">
						<span class="steps-num">Step 4</span>
						<span class="title">Checkout </span>		
						<span class="arrow"><img src="<?= base_url() ?>images/buttons/arrow.png" alt="arrow" width="25" height="14" /></span>								
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="steps-btn">
				<span class="prev"><a href="<?=base_url()?>products/wood_fittings">&lt;&lt; Previous Step</a></span>
				<span ><input type="submit" value="Next Step &gt;&gt;" name="next-btn" id="next-btn" class="next" /></span>
			</div>
			<div class="left-panel" style="width:0px;background:white">
				
			</div>
			<div class="product-detail1" style="float:left;width:850px;">										
				<table class="shoppingcart" cellspacing="0" cellpadding="0" border="0" style="border:0px solid black">
				<thead>
					<thead>
					<tr>
						<th >Suggested Items</th>
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
						<td class="money">$215.00<input type="hidden" name="price[4372]" value="215.00" /></td>
						<td class="money"><select>
										<option>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
										<option>6</option><option>8</option><option>8</option><option>9</option><option>10</option>
										</select>
						</td>
						<td class="money">$<span>215.00</span><br /><br />
							<a href="" class="cbtn remove cartupdate" style="color:#888888; border:1px solid #dddddd; padding:4px;">add item</a>
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
							<td style="width:400px">
								<div class="cartthumb"><img src="<?= base_url() ?>images/banners/products/details/image1.jpg" alt="Giselle King Headboard"></div>
								<div class="cartfabric"><a><img src="<?= base_url() ?>images/banners/products/905501.jpg" alt="Lotus" /></a></div>
								<div class="cartdesc"><br/>
									<h5># 358533 - Manchester King Headboard</h5><br/>
									<p>Category: <em><b><?php echo $s['category'] ?></b></em>, Model: <em><b><?php echo $s['model'] ?></b></em>, Size: <em><b><?php echo $s['size'] ?></b></em></p>
								</div>
							</td>
										<td class="money">$<?php echo number_format($s['price'], 2, '.', ' ') ?><input type="hidden" name="price[4372]" value="<?php echo number_format($s['price'], 2, '.', ' ') ?>" /></td>
							<td class="money">
								<select>
											<option>0</option><option selected>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
											<option>6</option><option>8</option><option>8</option><option>9</option><option>10</option>
											</select>
							</td>
							<td class="money">$<span><?php echo number_format($s['price'], 2, '.', ' ') ?></span><br /><br />
								<a href="?edit=<?php echo $s['id'] ?>" class="edit-cart-item" title="Edit Item">&nbsp;</a>&nbsp;&nbsp;
								<a href="?remove=<?php echo $s['id'] ?>" class="remove-cart-item" title="Remove Item">&nbsp;</a>
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
				<div class="clear"></div><br/><br/>
				<div class="steps-btn" style="width:800px;">
					<span class="next"><a href="#">Checkout</a></span>
				</div>		
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear" style="height:10px;"></div>
	</div>
	
	<div><img src="<?= base_url() ?>images/b-curve.png" alt="bottom curve" width="972" height="11"c /></div>
</div>
</form>
<br /><br /><br /><br />