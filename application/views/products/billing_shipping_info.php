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
input[type="text"],
input[type="email"] {
	width: 230px;
	padding: 2px;
}
</style>
<div id="inner-content">
	<div id="main-content" style="overflow:hidden;height:400px;">

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
			<a href="<?=base_url()?>products/checkout" class="previous"><span>«</span> Previous Step</a>
		</div>
			
		<div id="content">
		<p>&nbsp;</p>
		<?php echo form_open('products/billing_shipping_info');?>
			<div class="left-column">
				<h3>Billing Information</h3>
				
				<label>First Name</label>
				<input type="text" name="data[billing_firstname]" required class="billing-field" rel="shipping-firstname"/>
				
				<label>Last Name</label>
				<input type="text" name="data[billing_lastname]" required class="billing-field" rel="shipping-lastname"/>
				
				<label>Email Address</label>
				<input type="email" name="data[billing_email]" required  placeholder="Enter a valid email address" class="billing-field" rel="shipping-email"/>
				
				<label>Address</label>
				<input type="text" name="data[billing_address]" required class="billing-field" rel="shipping-address"/>
				<input type="text" name="data[billing_address2]" rel="shipping-address2" />
				
				<label>City</label>
				<input type="text" name="data[billing_city]" required class="billing-field" rel="shipping-city"/>
				
				<label>State</label>
				<input type="text" name="data[billing_state]" required class="billing-field" rel="shipping-state"/>
				
				<label>Region</label>
				<input type="text" name="data[billing_region]" required class="billing-field" rel="shipping-region"/>
	
				<label>Town</label>
				<input type="text" name="data[billing_town]" required class="billing-field" rel="shipping-town"/>
	
				<label>Postal Code</label>
				<input type="text" name="data[billing_postal]" required class="billing-field" rel="shipping-postal"/>
				
				<label>Telephone</label>
				<input type="text" name="data[billing_telephone]" required class="billing-field" rel="shipping-telephone"/>
				
				<label for="same-shipping">
				<input type="checkbox" name="same" id="same-shipping"/>
				Billing Address is the same as Shipping Address.
				</label>
			</div>
		
			<div class="right-column">
				<h3>Shipping Information</h3>
				
				<label>First Name</label>
				<input type="text" name="data[shipping_firstname]" required id="shipping-firstname"/>
				
				<label>Last Name</label>
				<input type="text" name="data[shipping_lastname]" required id="shipping-lastname"/>
				
				<label>Email Address</label>
				<input type="email" name="data[shipping_email]" required placeholder="Enter a valid email address" id="shipping-email" />
				
				<label>Address</label>
				<input type="text" name="data[shipping_address]" required id="shipping-address"/>
				<input type="text" name="data[shipping_address2]" id="shipping-address2"/>
				
				<label>City</label>
				<input type="text" name="data[shipping_city]" required id="shipping-city"/>
				
				<label>State</label>
				<input type="text" name="data[shipping_state]" required id="shipping-state"/>
				
				<label>Region</label>
				<input type="text" name="data[shipping_region]" required id="shipping-region"/>
	
				<label>Town</label>
				<input type="text" name="data[shipping_town]" required id="shipping-town"/>
	
				<label>Postal Code</label>
				<input type="text" name="data[shipping_postal]" required id="shipping-postal"/>
				
				<label>Telephone</label>
				<input type="text" name="data[shipping_telephone]" required id="shipping-telephone"/>
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

<script type="text/javascript" defer="defer">

(function(){

	$('.billing-field').blur(function(){
			if($('input[name=same]').prop('checked') == true)
			{
				$this = $(this);
				$('#' + $this.attr('rel')).val($this.val());
			}
		}
	);

	$('input[name=same]').change(function(){
		if($(this).prop('checked') == true)
		{
			$inputs = $('.billing-field');
			jQuery.each($inputs, function(i, element){
				
				target = $('#' + $(element).attr('rel'));
				//
				target.val($(element).val());
			});
		}
	});
})();



</script>