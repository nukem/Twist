<style>
label {
	display: block;
	margin-top: 8px;
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

.left-column {
	width: 310px;
	margin-right: 8px;
	float: left;
}
.right-column {
	width: 310px;
	float: left;
} 
</style>
<div id="inner-content">
	<div id="main-content" style="overflow:hidden;height:400px;">

			<div class="steps" id="steps">
				<img src="/img/step-1.gif">
				<span id="step1" class="step-active">Contact Information</span>
	            <span id="step2">Order Review</span>
	            <span id="step3">Payment</span>
	            <span id="step4">Done</span>
				<div class="clear"></div>
			</div>
		
		<div id="content">
		<?php echo form_open('products/billing_shipping_info');?>
			<div class="left-column">
				<h3>Billing Information</h3>
				
				<label>First Name</label>
				<input type="text" name="data[billing_firstname]" required />
				
				<label>Last Name</label>
				<input type="text" name="data[billing_lastname]" required />
				
				<label>Email Address</label>
				<input type="text" name="data[billing_email]" required />
				
				<label>Address</label>
				<input type="text" name="data[billing_address]" required />
				<input type="text" name="data[billing_address2]" />
				
				<label>City</label>
				<input type="text" name="data[billing_city]" required />
				
				<label>State</label>
				<input type="text" name="data[billing_state]" required />
				
				<label>Region</label>
				<input type="text" name="data[billing_region]" required />
	
				<label>Town</label>
				<input type="text" name="data[billing_town]" required />
	
				<label>Postal Code</label>
				<input type="text" name="data[billing_postal]" required />
				
				<label>Telephone</label>
				<input type="text" name="data[billing_telephone]" required />
			</div>
		
			<div class="right-column">
				<h3>Shipping Information</h3>
				
				<label>First Name</label>
				<input type="text" name="data[shipping_firstname]" required />
				
				<label>Last Name</label>
				<input type="text" name="data[shipping_lastname]" required />
				
				<label>Email Address</label>
				<input type="text" name="data[shipping_email]" required />
				
				<label>Address</label>
				<input type="text" name="data[shipping_address]" required />
				<input type="text" name="data[shipping_address2]" />
				
				<label>City</label>
				<input type="text" name="data[shipping_city]" required />
				
				<label>State</label>
				<input type="text" name="data[shipping_state]" required />
				
				<label>Region</label>
				<input type="text" name="data[shipping_region]" required />
	
				<label>Town</label>
				<input type="text" name="data[shipping_town]" required />
	
				<label>Postal Code</label>
				<input type="text" name="data[shipping_postal]" required />
				
				<label>Telephone</label>
				<input type="text" name="data[shipping_telephone]" required />
			</div>
			<p style="clear:both;">&nbsp;</p>
			<div id="options-bar" style="clear:both;width:100%;margin-top:12px;padding: 8px 12px 0px 0px;text-align: right;">
				<input class="options" style="border:none;" type="submit" value="Continue" />
			</div>
		</form>
		</div>
	</div>
	<p style="clear:both;">&nbsp;</p>
	<?php echo validation_errors();?>
</div>