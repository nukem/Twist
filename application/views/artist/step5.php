<?php
$test = $this->session->userdata('is_loged');
$test_id = $this->session->userdata('artist_id');
$ids = $this->session->userdata('artists');
$uri_test = $this->uri->segment(3);
if($test  == '1' && !empty($test)){?>
<h1>Edit your profile</h1>
			
<?php } else{
$this->session->set_userdata('is_loged', false);
$this->session->set_userdata('artist', null);
$test_id = '';
?>
<h1>Join as an Artist</h1>
		
<?php } ?>	
			
			<div class="<?php if($uri_test != $test_id ) echo 'step';else echo 'editstep';?> step5">step</div>
			<!--<div class="line_help"><a href="#">click here for help</a></div>-->
<br/>
			<form action="" method="post" class="uniform">
			<fieldset>
				<table width="100%"><tr width="100%">
					<td width="50%"><h2>FINAL DETAILS<h2></td>
					<td width="50%" align="right"><div align=right class="form_title"><span>*</span> This indicates a mandatory field</div></td>
				</tr></table>
				<h2>STEP 5 of 6</h2>
				<div class="form_title">
					Okay, let's get you paid
					<strong class="bubble_info">
						<img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
						<strong class="popup"><b>arrow</b><em>Soundbooka allows you to be paid by PayPal or in cash. In both instances Soundbooka will provide you with a remittance advice for any performance fees received. You can create a PayPal account <a target="_blank" href="http://paypal.com">here</a>.</em></strong>
					</strong>
				</div>
				<div class="form_block">
					<div class="note_box note_box2"><span>arrow</span>Soundbooka uses <a target="_blank" href="http://paypal.com">PayPal</a> to secure your transactions. PayPal is free for you to join and use. You will need to maintain/open a PayPal account to receive payments from Soundbooka. If you change your PayPal email address/login, you must notify Soundbooka otherwise payments may fail to you. Until you register with PayPal Soundbooka will not be able to make payments to you, although payments will be held for you.</div>
					<p>How would you like to receive your Performance Fee ?</p>
					<div class="form_row">
						<label>Payment method <span>*</span></label>
						
						<div class="form_item">
							<div class="option_holder">
								<div class="option">
									<label>
										<input name="payment_method" type="radio" value="1" <?php echo set_radio('payment_method', '1',((1==$payment_method) ? TRUE:FALSE)); ?> />
										<strong>PayPal</strong>
									</label>
								</div>
								<div class="option">
									<label>
										<input name="payment_method" type="radio" value="2" <?php echo set_radio('payment_method', '2',((2==$payment_method) ? TRUE:FALSE)); ?>/>
										<strong>Cash</strong>
									</label>
								</div>
								<div class="option">
									<label>
										<input name="payment_method" type="radio" value="3" <?php echo set_radio('payment_method', '3',((3==$payment_method) ? TRUE:FALSE)); ?>/>
										<strong>Either</strong>
									</label>
								</div>
							</div>
						</div><!--end of form_item-->
						
						<div class="form_item">
							<input name="paypal_email" type="text" class="input1 infotext" id="paypal_email" title="Paypal email address" value="<?= set_value('paypal_email', ((@$paypal_email) ? $paypal_email: 'Paypal email address'));?>" /> <img src="<?=base_url()?>images/img_paypal.gif" alt="" />
							<em><a target="_blank" href="http://paypal.com">Click here</a> to create a PayPal account</em>
					  </div><!--end of form_item-->
						
						<br class="cl" />
					</div><!--end of form_row-->
					
				</div><!--end of form_block-->
				
				
				
				<div class="form_title">Your details for tax invoice purposes</div>
				<div class="form_block">
					<div class="form_row">
						<div class="form_item">
							<label>
								ABN 
								<strong class="bubble_info">
									<img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
									<strong class="popup"><b>arrow</b><em>To operate a business in Australia you need an Australian Business Number (ABN). If playing Gigs is your business (and not just a part time hobby) you are entitled to register for an ABN. To find out if you are entitled to register for an ABN and carry on a business visit <a href="http://www.abr.gov.au" target="_blank">www.abr.gov.au.</a> Soundbooka may require verification of your ABN.</em></strong>
								</strong>
							</label>
							<input name="abn" type="text" class="input1" id="abn" value="<?= set_value('abn', @$abn);?>" />
						</div>
						<div class="form_item">
							<label>Business Name </label>
							<input name="business_name" type="text" class="input1" id="business_name" value="<?= set_value('business_name', @$business_name);?>"/>
						</div>
						<br class="cl" />
					</div><!--end of form_row-->
					
					<div class="form_row">
						<div class="form_item">
							<label>Address <em>(if different  from personal)</em></label>
							<textarea name="business_address" class="textarea1" id="business_address"><?= set_value('business_address', @$business_address);?></textarea>
						</div>

						<div class="form_item">
							<label>
								GST registered  ? <span>*</span>
								<strong class="bubble_info">
									<img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
									<strong class="popup"><b>arrow</b><em>If you are entitled to an ABN, you may also be required to register for GST. This is important as if you are registered for GST Soudbooka will include GST in the tax invoices it sends to Bookers on your behalf. If you say you are registered for GST, and in fact you are not, you will still be required to remit the GST you collect to the ATO. You can view more information about registering for GST at <a href="http://www.abr.gov.au" target='_blank'>www.abr.gov.au.</a></em></strong>
								</strong>
							</label>
							<div class="options">
								<label>
									<input name="has_gst" type="radio" value="1" <?php echo set_radio('has_gst', '1',((1==$has_gst) ? TRUE:FALSE)); ?>/>
									<strong>Yes</strong>
						    </label>

								<label>
									<input name="has_gst" type="radio" value="0" <?php echo set_radio('has_gst', '0',((0==$has_gst) ? TRUE:FALSE)); ?>/>
									<strong>No</strong>
								</label>
							</div>
						</div>
						<br class="cl" />
					</div><!--end of form_row-->
					
				</div><!--end of form_block-->
				
				
				<div class="shadow_line_nobg">line</div>
				
				<input type="submit" value="Save &amp; Continue" class="input_continue" name="save" />
				
				<input type="button" value="Back" class="btn_back2" name="back" onclick="location.href = '<?php echo base_url() ?>artist/step4/<?php echo($id);?>'" />
				
				<!--<a href="<?php echo base_url() ?>artist/step4/<?php echo $uri_test;?>" class="btn_back2" >Back</a>-->
				
				<br class="cl" />

			</fieldset>
			</form>
			
			<br class="cl" />
		
        
