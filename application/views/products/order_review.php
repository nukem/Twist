<style>
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

#steps	{
	position: relative;
	border-bottom: none;
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

.cart-item-options {
	list-style-type: none;
}
.cart-item-options > li {
	width: 80px;
	height: 90px;
	display: inline-block;
	vertical-align: top;
}
.cart-item-options > li div {
	overflow: hidden;
	width: 60px;
	height: 60px;
	display: block;
}
.cart-item-options > li > div > img {
	height: 60px;
}
.cart-items-options > li > p {
	text-align: center;
}
</style>
<div id="inner-content">
	<div id="main-content" style="overflow:hidden;height:400px;">
			<div class="steps" id="steps">
				<img src="/img/step-2.gif">
				<span id="step1">Contact Information</span>
	            <span id="step2" class="step-active">Order Review</span>
	            <span id="step3">Payment</span>
	            <span id="step4">Done</span>
				<div class="clear"></div>
			</div>
		
		<div id="content">
		<h2>Review Your Order</h2>
<p>&nbsp;</p>		
		<table class="shoppingcart" cellspacing="0" cellpadding="0" border="1" background-color:#333;width:100%;>

			<tbody>			
<?php	$total = 0;
		foreach($shoppingcart_all as $s):
			$total += $s['price'];
?>
			<tr>
				<td>
					<div class="cartthumb">
						<?php echo img(array(
									'src' => 'wpdata/images/'.$s['Model'][0]['images'][0]['id'].'-s.jpg',
									'height' => '80%',
							)
						);?>
					</div>
				</td>
				<td style="vertical-align:top;">
					<h5><?php echo $s['model'] . ' ' . $s['size']?> Size Bed</h5><br/>
					
					<ul class="cart-item-options">
						<li>

							<div class="cartfabric" style="overflow:hidden;padding:0;" id="cover-image-<?php echo $s['id'];?>" >
											<?php 	if(!empty($s['Fabric'])):
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
													elseif(!empty($s['Leather'])):
														echo img('wpdata/images/'.$s['Leather'][0]['images'][0]['id'].'-s.jpg');
														$vartag = "Leather";
												 	endif;
												echo "</div>";
												echo "<p>$vartag</p>";
											?>
						</li>
						
						<li>
							<div>
								<?php 
									echo img(array(
													'src' => 'wpdata/images/'.$s['Nail'][0]['images'][0]['id'].'-s.jpg',
													'id' => 'nail-image-'.$s['id']
												)
											);
								?>
							</div>
							<p>Nails</p>
						</li>
						
						<li>						
							<div>
								<?php 
									echo img(array(
													'src' => 'wpdata/images/'.$s['Legs'][0]['images'][0]['id'].'-s.jpg',
													'id' => 'leg-image-'.$s['id']
												)
											);
								?>
							</div>
							<p>Legs</p>
						</li>
					</ul>	
				</td>
				
				<td class="money" style="vertical-align:top;">
					$<?php echo number_format($s['price'], 2, '.', ' ') ?>
				</td>
			</tr>
<?php 	endforeach;?>
		</tbody>
		
		<tfoot>
			<tr>
				<td colspan="5">
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

</td>
				<td>
			</tr>
		</tfoot>
		

				
		</table>
		
	 <div class="clear"></div><br/>
	 	 <div id="options-bar" style="text-align:right;width:auto;height:55px;padding-right:12px;padding-top:8px;" >
	 	 <form action="https://www.paypal.com/cgi-bin/webscr" method="post" >
	 	 <input type="hidden" name="cmd" value="_s-xclick" />
	 	 <input type="hidden" name="amount" value="<?php echo  $total + 100 + $tax; ?>" />
	 	 <input type="hidden" name="hosted_button_id" value="WKMSRW4YCZSVE" />
	 	 <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_xpressCheckout.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online." />
	 	 </form>
	</div>    		
</div>
</div>