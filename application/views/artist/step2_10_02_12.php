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
			
			<div class="<?php if($uri_test != $test_id ) echo 'step';else echo 'editstep';?> step2">step</div>
			
			<form action="" method="post" enctype="multipart/form-data" class="uniform">
			<fieldset>
				<br/>
				<table width="100%"><tr width="100%">
					<td width="50%"><h2>ARTIST SETUP</h2></td>
					<td width="50%" align="right"><div align=right class="form_title"><span>*</span> This indicates a mandatory field</div></td>
				</tr></table>
				<h2>STEP 2 of 6</h2>
				<div class="form_title">Now, let's hear more about you!</div>
				<div class="form_block">

					<p>
						The information you enter here will allow you to play the gigs you want to play.<br /> It will form the information that will be displayed on your Soundbooka Profile Page.
						<strong class="bubble_info">
							<img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
							<strong class="popup"><b>arrow</b><em>Your Profile Page will be available to visitors to soundbooka.com. Your Soundbooka Profile Page displays performance information and acts as your performance resume.</em></strong>
						</strong>
					</p>

					<div class="form_row">
						<div class="form_item" style="margin-bottom:0px;">
								<label>Profile Type <span>*</span>
                            	<strong class="bubble_info">
									<img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
									<strong class="popup"><b>arrow</b><em>You can create multiple Soundbooka Profile Pages. Simply complete your first Profile Page, then login and select a new Profile Type.</em></strong>
								</strong>
                            </label>
                            <div class="simu_select1">
							<?=form_dropdown('profile_type', $types, set_value('profile_type',@$profile_type), 'id=profile_type')?>
							</div>
						</div>
						<script>
						$(function(){
							$('#profile_type').change(function(){
								$v=$(this).val();
								if($v==1) {$('#instrument_type').text('Please type musician names');$('#instrument_head').text('Musician Names');}
								
								else {$('#instrument_type').text('Pleast type Instrument');$('#instrument_head').text('Instruments');}
							});						
							$('#profile_type').change();
						});
						</script>
						<div class="form_item">					
							<label>
								Profile Name <span>*</span>
								<strong class="bubble_info">
									<img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
									<strong class="popup"><b>arrow</b><em>Your Profile Name is the name you perform under. This name will be displayed on your Profile Page and appear in search results.</em></strong>
								</strong>
							</label>
							<input name="profile_name" type="text" class="input6" id="profile_name"  value="<?php echo set_value('profile_name', @$profile_name); ?>"/>
							
						</div>
						<br class="cl" />
					</div><!--end of form_row-->

				</div><!--end of form_block-->
				
				
				
<div id="step2" <?= (set_value('profile_type',@$profile_type) != '' && set_value('profile_type',@$profile_type) != '0') ? '':'style="display:none"'?>>				
				
				
				<div class="shadow_line_nobg">line</div>
                
                
<div id="div_specialization" style="display:none">                
			<div class="form_title">Specialisation <span>*</span></div>
				<div class="form_block">
					<div class="form_row">
                    <div class="form_item">
						<label>What type of audio services do you specialize in?</label>
                        <br class="cl" />
                        <? $specializations_grp = array_chunk($specializations,3,true); ?>
                        
                        <? foreach ($specializations_grp as $sgrp) : ?>
						<div class="option_col">
                        <? foreach ($sgrp as $k=>$s) : ?>
                        <div class="options">
								<label style="margin-bottom:5px">
									<input class="specialization" name="specialization_arr[]" type="checkbox" id="specialization_<?=$k?>" value="<?=$k?>" <?=(in_array($k,@$specialization) ? 'checked="checked"':'')?>/>
									<strong><?=$s?></strong>
						    </label>
                          </div>  
                        <? endforeach; ?>
                        </div>
                        <? endforeach; ?>
                       	</div>
                        	<br class="cl" />
                        </div>
				</div><!--end of form_block-->
                
                <div class="shadow_line_nobg">line</div>
                
                <div class="form_title">Preferred Medium</div>
				<div class="form_block">
                <div class="form_row">
                    <div class="form_item">
						<label>What medium do you most like to work in?</label>
                        <br class="cl" />
						<div class="options">
                        <? foreach ($mediums as $k=>$s) : ?>
								<label style="margin-bottom:5px">
									<input class="preferred_medium" name="preferred_medium_arr[]" type="checkbox" id="preferred_medium_<?=$k?>" value="<?=$k?>" <?=(in_array($k,@$preferred_medium) ? 'checked="checked"':'')?>/>
									<strong><?=$s?></strong>
						    </label>
                        <? endforeach; ?>
                        </div>
                       	</div>
                    <br class="cl" />
                    </div>
				</div><!--end of form_block-->
                <div class="shadow_line_nobg">line</div>
				
				
</div> <?php
		if(!empty($_POST)){
			if(!empty($_POST['dj_combo']))	$dj_combo=$_POST['dj_combo'];
			else	$dj_combo=1;
		}
	?>                
				
                <div class="form_block" id="div_djcombo" style="display:none">
				<div class="form_title">DJ Combo<span>*</span></div>
                <p>Do you perform with another artist when you DJ?</p>
                <div class="options">
						<label>
							<input name="dj_combo" type="radio" id="dj_combo_1" class="dj_combo" value="1" <?php echo set_radio('dj_combo', 1, ((1==$dj_combo) ? TRUE:FALSE)); ?> />
							<strong>Yes I perform with another musician</strong>
				    </label>
                    
                    <label>
							<input name="dj_combo" type="radio" id="dj_combo_2" class="dj_combo" value="2" <?php echo set_radio('dj_combo', 2, ((2==$dj_combo) ? TRUE:FALSE)); ?>/>
							<strong>Yes I perform with another DJ</strong>
						</label>
						
						<label>
							<input name="dj_combo" type="radio" id="dj_combo_0" class="dj_combo" value="0" <?php echo set_radio('dj_combo', 0, ((!$dj_combo) ? TRUE:FALSE)); ?>/>
							<strong>No I do not perform as part of a Combo</strong>
						</label>
					</div>
                </div>
                
                <div id="div_dj" style="display:none;">
				<div class="form_block">
                    <div class="form_row">
							<span class="label" style="margin-right:5px;">Total number of members in group</span><input type="text" class="input1" name='no_of_members' value="<?=intval(set_value('no_of_members',@$no_of_members))?>"  id="no_of_members" style="width:60px;text-align:right"/>
						<br class="cl" />
					</div>
				</div><!--end of form_block-->
                </div>
                
                <div id="div_instruments" style="display:none">
				<!--div class="form_title" id="DJ_combo_type_heading">Instruments</div-->
                <div class="form_title" id="instrument_heading" style="display:none">Instruments<span>*</span></div>
				<div class="form_block">
					<p id="DJ_combo_type_text">What type of artists do you perform with?</p>
					<p id="solo_combo_type_text" style="display:none">What type of instrument do you play?</p>
                    <p id="band_type_text" style="display:none">What is your band/group's line up?</p>

					<div class="form_row">
						<!--<div class="form_item">
							<label>Please select instrument category<span>*</span></label>
							<div class="simu_select1">
								<?//=form_dropdown('category', $categories, '', 'id=category')?>
							</div>
						</div>-->
                    
						<div class="form_item">
							<label><font id="instrument_type">Please type instrument</font> <span>*</span></label>
							<div class="simu_select1">
								<?//=form_dropdown('instrument', $instruments, '', 'id=instrument')?>
								<input name="instrument" type="text" class="input1" id="instrument" />
							</div>
						</div>
						
						<div class="form_item">
							<label>
								<span class="instrument-description" style="color:#5F5F5F">Description</span>
								<strong class="bubble_info">
									<img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
									<strong class="popup"><b>arrow</b><em>Here you can describe your sound. You might be a guitarist who has a bluesy edge or be a singer with a soulful groove. Include this information in 25 words or less.</em></strong>
								</strong>
							</label>
							<input name="comment" type="text" class="input1" id="comment" />
                            <input name="ai_id" id="ai_id" type="hidden" value="0" />
						</div>
						
						<a href="javascript:void(0)" class="btn_add">Add</a>
						<br class="cl" />
					</div><!--end of form_row-->
					
					<table class="instrument_table">
					  <tr>
					    <th width="32%" id="instrument_head">Instruments</th>
					    <th width="57%" class="instrument-description">Description</th>
					    <th width="11%">&nbsp;</th>
					  </tr>
					  <?php 
					  $sql = "select * from artist_Instruments where artist_id = '".$this->uri->segment(3)	 ."'order by id";
					  $result = mysql_query($sql);
					  while($row=mysql_fetch_array($result)){
								$artist_instrumentsa[]=$row;
						}
					  
					  $i = 0;
					  if(!empty($artist_instrumentsa) && count($artist_instrumentsa) > 0){
					  foreach($artist_instrumentsa as $key){
						
						?>
						 <tr <?=($i%2) ? 'class="tr_even"':''?> id="tr_<?php print_r($key['id']);?>" rel="">
					    <td rel="<?php print_r($key['instrument_name']);?>"><?php print_r($key['instrument_name']);?></td>
					    <td><?php print_r($key['comment']);?></td>
					    <td class="td_link"><a href="javascript:void(0)" rel="<?php print_r($key['id']);?>" class="remove">remove</a> | <a href="javascript:void(0)" rel="<?php print_r($key['id']);?>" class="edit">edit</a></td>
					  </tr>
					  <?php
					  $i++;
					  }
					  
					 }
					  ?>
                     				  
					</table>
				</div><!--end of form_block-->
				</div>
				
                <div class="form_title div_genre" style="display:none">
					Genres <span>*</span>
					<strong class="bubble_info">
						<img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
						<strong class="popup"><b>arrow</b><em>We cater to every type of preforming artist on Soundbooka. By selecting the genres that best describe your sound we can provide you with the gigs that best match your skill set.</em></strong>
					</strong>
				</div>
				<div class="form_block div_genre" style="display:none;">
					<p>Please select the genres that best describe your sound</p>
					<div class="form_row">
						
							<?php 
								$result = mysql_query("select * from genre where active ='1' and user_id in ('0','".$this->uri->segment(3)."') order by genre");
								$genres = array();
								while($row=mysql_fetch_array($result)){
									$genres[$row['artist_type']][] = array('id'=>$row['genre_id'],'genre'=>$row['genre']);
								}
								//print_r($genres);die;
								$result_generic = mysql_query("select genre1 from artist where id = '".$this->uri->segment(3)."'");
								while($row=mysql_fetch_array($result_generic)){
									$test = $row['genre1'];
								}
								if(empty($_POST['genre'])) $test=explode(',',$test);
								else $test=$_POST['genre'];
								echo '<div style="display:none;">'; print_r($test); echo '</div>';
								foreach ($genres as $at=>$gs) {
									
								?>
								<div class="option_col_x at_<?=$at?>" style="display:none">
                                	<? if (!isset($genre)) $genre = array(); ?>
                                    <? $gs = array_chunk($gs,6,1); ?>
                                    <? foreach ($gs as $gsx) : ?>
                                    <div class="option_col">
									<? foreach ($gsx as $g) {?>
                                    	
										<div class="option">
											<label>
												<input type="checkbox" class="id_<?=$g['id']?> genre" name="genre[]" id="genre" value="<?=$g['id']?>" <?=(in_array($g['id'],@$test) ? 'checked="checked"':'')?>/>
												<strong><?php echo $g['genre'];?></strong>
											</label>
										</div>
                                        
                                    <? } ?>
                                    <br class="cl" /></div>
                                    <? endforeach; ?>
								<br class="cl" />
								</div><!--end of option_col-->
								<?php } ?>
						
						
				</div><!--end of form_block-->
                <div class="shadow_line_nobg">line</div>
 	<?php
		if(!empty($_POST)){
			if(!empty($_POST['needed_equipment_arr']))	$needed_equipment=$_POST['needed_equipment_arr'];
			else	$needed_equipment=array();
			if(!empty($_POST['equipment']))	$equipment=$_POST['equipment'];
			else	$equipment=1;
		}
	?>     
	</div>
                <div id="div_equipment" style="display:none; ">
				<div class="form_title">Equipment<span>*</span></div>
				<div class="form_block">
					<p>Do you supply your own equipment when you perform or do you require it to be supplied?</p>
					
                    <!--div class="form_row">
						<label>Please select</label>
						<div class="simu_select1">
							<?//=form_dropdown('equipment', $equipments, set_value('equipment',@$equipment), 'id=equipment')?>
						</div>
						<br class="cl" />
					</div-->
                    <div class="options">
						<label>
							<input name="equipment" type="radio" id="equipment_1" class="equipment" value="1" <?php echo set_radio('equipment', 1, ((1==$equipment) ? TRUE:FALSE)); ?> />
							<strong>I perform on my own equipment</strong>
				    </label>
						
						<label>
							<input name="equipment" type="radio" id="equipment_0" class="equipment" value="0" <?php echo set_radio('equipment', 0, ((!$equipment) ? TRUE:FALSE)); ?>/>
							<strong>I require equipment to perform </strong>
						</label>
					</div>
				</div><!--end of form_block-->
                
                <!--              -->
                <div class="form_block" id="div_needed_equipment" style="display:none">
					<div class="form_row">
						<div class="form_item">
							<div class="options">
								<label>
									<input name="needed_equipment_arr[]" type="checkbox" id="needed_equipment_1" class="needed_equipment" value="CDJs" <?=(in_array('CDJs',@$needed_equipment) ? 'checked="checked"':'')?> onclick="showNeedEquNo(0)"/>
									<strong>CDJs</strong>
								</label>
								<label>
									<input name="needed_equipment_arr[]" type="checkbox" id="needed_equipment_2" class="needed_equipment" value="Mixer" <?=(in_array('Mixer',@$needed_equipment) ? 'checked="checked"':'')?> />
									<strong>Mixer</strong>
								</label>
								
								<label>
									<input name="needed_equipment_arr[]" type="checkbox" id="needed_equipment_3" class="needed_equipment" value="Vinyl Turntables" <?=(in_array('Vinyl Turntables',@$needed_equipment) ? 'checked="checked"':'')?>  onclick="showNeedEquNo(1)"/>
									<strong>Vinyl Turntables</strong>
								</label>
								
								<!--<label>
									<input name="needed_equipment_arr[]" type="checkbox" id="needed_equipment_4" class="needed_equipment" value="Mixer" <?=(in_array('Mixer',@$needed_equipment) ? 'checked="checked"':'')?> />
									<strong>Mixer</strong>
						    </label>-->
								
								<label>
									<input name="needed_equipment_arr[]" type="checkbox" id="needed_equipment_5" class="needed_equipment" value="Headphones" <?=(in_array('Headphones',@$needed_equipment) ? 'checked="checked"':'')?> />
									<strong>Headphones</strong>
						    </label>
								
								<label>
									<input name="needed_equipment_arr[]" type="checkbox" id="needed_equipment_6" class="needed_equipment" value="Serato Box" <?=(in_array('Serato Box',@$needed_equipment) ? 'checked="checked"':'')?> />
									<strong>Serato Box</strong>
						    </label>
									
									<div id='need_equ_no_div' style="display:none;">
									<span id="CDJS_textbox" style="padding-top:20px;display:none; " >No. <input type="text" name="other_CDGS" class="input1" id="other_CDGS" value="" style="width:50px;"/> </span>								
									<span id="vinyl_textbox" style="padding-top:20px; padding-left:60px;display:none;" >No. <input type="text" name="other_vinyl" class="input1" id="other_vinyl" value="" style="width:50px;"/> </span>								
									</div>
							</div>
						</div><!--end of form_item-->
						<br class="cl" />  
					</div><!--end of form_row-->
				</div>
                
                
                <!--            -->
                
                <div class="shadow_line_nobg">line</div>
                </div>
				
	<?php
		if(!empty($_POST)){
			if(!empty($_POST['gigs_arr']))	$artist_gigs_array=$_POST['gigs_arr'];
			else	$artist_gigs_array=array();
		}
	?>
				
                <div id="div_gig">
				<div class="form_title">Preferred Gig<span>*</span></div>
				<div class="form_block">
					
					<div class="form_row"><label>Where do you most like to perform? <span>*</span></label>
                        <? $gigs_grp = array_chunk($gigs, 3, true); ?>
                        <? foreach ($gigs_grp as  $ggrp) : ?>
                        <div class="option_col">
                        <? foreach ($ggrp as $k=>$g) : ?>
                        <div class="options">
							<label>
									<input name="gigs_arr[]" type="checkbox" value="<?=$k?>" <?= (in_array($k, @$artist_gigs_array)) ? 'checked="checked"':'' ?> />
									<strong><?= str_replace("'","",$g); ?></strong>
						    </label>
                        </div>
						<? endforeach; ?>	
                        </div>
                        <? endforeach; ?>
                        <br class="cl" />
					</div>
				</div><!--end of form_block-->
				</div>
				<div class="form_title">
					Performance Fee<span>*</span> 
					<strong class="bubble_info">
						<img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
						<strong class="popup"><b>arrow</b><em>This is how much you charge to perform. Soundbooka will deduct their Fee from this amount. You can select how much you charge per hour or per gig/session. All amounts are in $AUD.</em></strong>
					</strong>
				</div>
				<!--end of form_block-->
				<div class="form_block">
					<div class="note_box" style="top:-20px"><span>arrow</span>At no time will your Performance Fee be displayed to the public or bookers.</div>
					
					<div class="form_row">
						<div class="form_item">
							<label>What is your minimum fee per hour? <span>*</span></label>
                            <span class="label">$ </span><input type="text" class="input1" name="fee_hour" id="fee_hour" value="<?php echo set_value('fee_hour',@$fee_hour); ?>" style="width:50px;text-align:right" />
						</div>
                        
                       <div class="form_item">
							<label>What is the minimum amount of time you are willing to perform?<span>*</span></label>
							<span style="float:left;margin-right:5px" class="label">No. of hours </span>
								<input type="text" class="input1" name='gig_hours' value="<?=set_value('gig_hours',@$gig_hours)?>" id='id=gig_hours' style="width:50px;text-align:right" />
							
						</div>
						
						
						<br class="cl" />
					</div><!--end of form_row-->
					<div class="form_row">
						<div class="form_item">
							<label> - OR -</label>
                    	</div>
                    <br class="cl" /></div>
					<div class="form_row">
						<div class="form_item">
							<label>What is your minimum fee per gig/session?<span>*</span></label>
							
                            <span class="label">$ </span><input type="text" class="input1" name="fee_gig" id="fee_gig" value="<?php echo set_value('fee_gig',@$fee_gig); ?>" style="width:50px;text-align:right"/>
						</div>
						<br class="cl" />
					</div><!--end of form_row-->
					
				</div><!--end of form_block-->
				
				<div class="shadow_line_nobg">line</div>
                
                  <?php
					if(!empty($_POST)){
						if(!empty($_POST['travel_city']))	$travel_city=$_POST['travel_city'];
						else	$travel_city=1;
						if(!empty($_POST['travel_state']))	$travel_state=$_POST['travel_state'];
						else	$travel_state=1;
						if(!empty($_POST['travel_interstate']))	$travel_interstate=$_POST['travel_interstate'];
						else	$travel_interstate=1;
						if(!empty($_POST['travel_international']))	$travel_international=$_POST['travel_international'];
						else	$travel_international=1;
					}
				?>             
                <div class="form_title">Travel<span>*</span></div>
				<div class="form_block">
					<div class="form_row">
                <div class="form_item">
                    <label>
                        How far are you willing to travel? <span>*</span>
                        <strong class="bubble_info">
                            <img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
                            <strong class="popup"><b>arrow</b><em>Please indicate how far you are willing to travel to a gig. Based on this information Soundbooka will ensure that you are for selected for gigs within your desired area</em></strong>
                        </strong>
                    </label>
                    
                    <div class="options">
								<label>
									<input name="travel_city" type="checkbox" id="travel_city" value="1"  <?php echo set_checkbox('travel_city', '1', ((1==$travel_city) ? TRUE:FALSE)); ?> />
									<strong>Within home city</strong>
						    </label>
								
								<label>
									<input name="travel_state" type="checkbox" id="travel_state" value="1" <?php echo set_checkbox('travel_state', '1', ((1==$travel_state) ? TRUE:FALSE)); ?>  />
									<strong>Within home state</strong>
						    </label>
								
								<label>
									<input name="travel_interstate" type="checkbox" id="travel_interstate" value="1" <?php echo set_checkbox('travel_interstate', '1', ((1==$travel_interstate) ? TRUE:FALSE)); ?> />
									<strong>Interstate</strong>
						    </label>
								
								<label>
									<input name="travel_international" type="checkbox" id="travel_international" value="1" <?php echo set_checkbox('travel_international', '1', ((1==$travel_international) ? TRUE:FALSE)); ?> />
									<strong>International</strong>
						    </label>
							
								
							</div>
                </div>
                <br class="cl" />
					</div><!--end of form_row-->
				</div><!--end of form_block-->
		<?php
			if(!empty($_POST)){
				if(!empty($_POST['availability']))	$artist_availability_array=$_POST['availability'];
				else	$artist_availability_array=array();
			}
		?>		
				<div class="form_title">Availability<span>*</span></div>
				<div class="form_block">
					<div class="form_row">
						<div class="form_item">
							<label>When are you available to perform? <span>*</span></label>
							<div class="options">
							<ul>
								<li class="options-span"><h6>Monday</h6>
									<input style="margin-left:5px" name="availability[]" type="checkbox" id="mon_day" value="mon_day" <?= (in_array('mon_day', @$artist_availability_array)) ? 'checked="checked"':'' ?> /><strong style="margin-right:5px"> Day</strong>
									<input name="availability[]" type="checkbox" id="mon_night" value="mon_night" <?= (in_array('mon_night', @$artist_availability_array)) ? 'checked="checked"':'' ?>  /><strong> Night</strong>
						    </li>
								
								<li class="options-span"> 
									<h6>Tuesday</h6>
									<input style="margin-left:5px" name="availability[]" type="checkbox" id="tue_day" value="tue_day" <?= (in_array('tue_day', @$artist_availability_array)) ? 'checked="checked"':'' ?> /><strong style="margin-right:5px"> Day</strong>
									<input name="availability[]" type="checkbox" id="tue_night" value="tue_night"  <?= (in_array('tue_night', @$artist_availability_array)) ? 'checked="checked"':'' ?> /><strong> Night</strong>
						    </li>
								
								<li class="options-span"> 
									<h6>Wednesday</h6>
									<input style="margin-left:5px" name="availability[]" type="checkbox" id="wed_day" value="wed_day" <?= (in_array('wed_day', @$artist_availability_array)) ? 'checked="checked"':'' ?> /><strong style="margin-right:5px"> Day</strong>
									<input name="availability[]" type="checkbox" id="wed_night" value="wed_night" <?= (in_array('wed_night', @$artist_availability_array)) ? 'checked="checked"':'' ?>  /><strong> Night</strong>
						    </li>
								
								<li class="options-span"> 
									<h6>Thursday</h6>
									<input style="margin-left:5px" name="availability[]" type="checkbox" id="thu_day" value="thu_day" <?= (in_array('thu_day', @$artist_availability_array)) ? 'checked="checked"':'' ?> /><strong style="margin-right:5px"> Day</strong>
									<input name="availability[]" type="checkbox" id="thu_night" value="thu_night"  <?= (in_array('thu_night', @$artist_availability_array)) ? 'checked="checked"':'' ?> /><strong> Night</strong>
						    </li>
								
								<li class="options-span"> 
									<h6>Friday</h6>
									<input style="margin-left:5px" name="availability[]" type="checkbox" id="fri_day" value="fri_day" <?= (in_array('fri_day', @$artist_availability_array)) ? 'checked="checked"':'' ?>/><strong style="margin-right:5px"> Day</strong>
									<input name="availability[]" type="checkbox" id="fri_night" value="fri_night" <?= (in_array('fri_night', @$artist_availability_array)) ? 'checked="checked"':'' ?>/><strong> Night</strong>
						    </li>
								
								<li class="options-span"> 
									<h6>Saturday</h6>
									<input style="margin-left:5px" name="availability[]" type="checkbox" id="sat_day" value="sat_day" <?= (in_array('sat_day', @$artist_availability_array)) ? 'checked="checked"':'' ?> /><strong style="margin-right:5px"> Day</strong>
									<input name="availability[]" type="checkbox" id="sat_night" value="sat_night" <?= (in_array('sat_night', @$artist_availability_array)) ? 'checked="checked"':'' ?>/><strong> Night</strong>
						    </li>
								
								<li class="options-span"> 
									<h6>Sunday</h6>
									<input style="margin-left:5px" name="availability[]" type="checkbox" id="sun_day" value="sun_day" <?= (in_array('sun_day', @$artist_availability_array)) ? 'checked="checked"':'' ?>/><strong style="margin-right:5px"> Day</strong>
									<input name="availability[]" type="checkbox" id="sun_night" value="sun_night" <?= (in_array('sun_night', @$artist_availability_array)) ? 'checked="checked"':'' ?> /><strong> Night</strong>
								</li>
							</ul>	
							</div>
						</div><!--end of form_item-->
						<br class="cl" />
					</div><!--end of form_row-->
				</div><!--end of form_block-->
				
	<?php
		if(!empty($_POST)){
			if(!empty($_POST['has_manager']))	$has_manager=$_POST['has_manager'];
			else	$has_manager=1;
		}
	?>			
				<div class="form_title">
					Management<span>*</span>
				</div>
				<div class="form_block">
        			<label>Do you have a manager? </label>

					<strong class="bubble_info">
						<img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
						<strong class="popup"><b>arrow</b><em>If you are a performer that has a manager or is represented by a management agency please fill out the required fields. Soundbooka will include your management on all communications.</em></strong>
					</strong>
		
				<div class="options">
						<label>
							<input name="has_manager" type="radio" id="has_manager" class="has_manager" onClick="$('#manager').show();" value="1" <?php echo set_checkbox('has_manager', 1, ((1==$has_manager) ? TRUE:FALSE)); ?> />
							<strong>I have management</strong>
						</label>
						<label>
							<input name="has_manager" type="radio" id="has_manager" onClick="$('#manager').hide();" class="has_manager" value="0" <?php echo set_checkbox('has_manager', 0	, ((1!=$has_manager) ? TRUE:FALSE)); ?> />
							<strong>I do not have management</strong>
						</label>
					</div>
                <br class="cl" />
					<div class="form_row" id="manager" style="display:none;">
						
						
						<div class="form_item">
							<label>Manager Name <span>*</span></label>
							<input name="manager_name" type="text" class="input6" id="manager_name" value="<?php echo set_value('manager_name', @$manager_name); ?>" />
						</div><!--end of form_item-->
						
						<div class="form_item">
							<label>Manager Email <span>*</span></label>
							<input name="manager_email" type="text" class="input6" id="manager_email" value="<?php echo set_value('manager_email', @$manager_email); ?>" />
						</div><!--end of form_item-->
						
						<div class="form_item">
							<label>Manager contact number <span>*</span></label>
							<input name="manager_phone" type="text" class="input6" id="manager_phone" value="<?php echo set_value('manager_phone', @$manager_phone); ?>" />
						</div><!--end of form_item-->
						
						<br class="cl" />
					</div><!--end of form_row-->
				</div><!--end of form_block-->
				
				
				<div class="form_title">
					Do you have insurance?<span>*</span>
					<strong class="bubble_info">
						<img src="<?=base_url()?>images/question_mark_icon.png" style = "width:15px;height:15px;" alt="" class="img_ask" />
						<strong class="popup"><b>arrow</b><em>Unless waived by the Booker, you will be required to have your own current public liability insurance for each Gig. If you do not have public liability insurance, you will not be able to perform at venues that require you to have public liability insurance. Soudbooka requires Artists to provide details of public liability insurance to be able to accept Gigs requiring public liability insurance.</em></strong>
					</strong>
				</div>
				<div class="form_block">
					<div class="form_row">
						<div class="form_item">
							<label>Please Select <span>*</span></label>
							<div class="options">
								<label>
									<input name="has_insurance" id="has_insurance" type="radio" value="1" <?php echo set_radio('has_insurance', '1',((1==$has_insurance) ? TRUE:FALSE)); ?> />
									<strong>Yes</strong>
							  </label>
								
								<label>
									<input name="has_insurance" id="has_insurance1" type="radio" value="0" <?php echo set_radio('has_insurance', '0', ((0==$has_insurance) ? TRUE:FALSE)); ?> />
									<strong>No</strong>
								</label>
							</div>
						</div><!--end of form_item-->
						
						<br class="cl" />
					</div><!--end of form_row-->
				</div><!--end of form_block-->
                
                </div>
				
				<div class="shadow_line_nobg">line</div>
				
				<input type="submit" value="Save &amp; Continue" class="input_continue" name="save" />
				
				<input type="button" value="Back" class="btn_back2" name="back" style="text-indent: 10px !important;" onclick="location.href = '<?php echo base_url() ?>artist/step1/<?php echo($id);?>'" />
				
				
				<!--<a href="<?php echo base_url() ?>artist/step1/<?php echo $uri_test;?>" class="btn_back2" >Back</a>-->
				
				<br class="cl" />

			</fieldset>
			</form>
			
			<br class="cl" />
<script>
$(function() {
	
	$('#fee_hour').keypress(function() {
		$('#fee_gig').val('0');
	});
	$('#fee_gig').keypress(function() {
		$('#fee_hour').val('0');
	});
	
	type = $('#profile_type').val();
	if (type) {
		$('.at_' + type).show();$('.div_genre').slideDown();
	}
	updateUI();
	
	$( "#slider" ).slider({
		range: "min",
		value: 400,
		min: 1,
		max: 5000,
		slide: function( event, ui ) {
			//$( "#slider a span" ).html( ui.value+ 'Km' );
			$( "#slider_value" ).html( ui.value+ 'Km' );
			$( "#travel_distance" ).val( ui.value );
		},
		change: function( event, ui ) {
			//$( "#slider a span" ).html( ui.value+ 'Km' );
			$( "#slider_value" ).html( ui.value+ 'Km' );
			$( "#travel_distance" ).val( ui.value );
		}
	});	
		
	$( "#slider" ).slider('value','<?php echo set_value('travel_distance',@$travel_distance); ?>');
	
	$( "#slider1" ).slider({
		range: "min",
		value: 0,
		min: 0,
		max: 2000,
		slide: function( event, ui ) {
			$( "#slider_value1" ).html( ui.value);
			$( "#fee_hour" ).val( ui.value );
			$( "#slider2" ).slider('value',0);
		},
		change: function( event, ui ) {
			$( "#slider_value1" ).html( ui.value );
			$( "#fee_hour" ).val( ui.value );
		}
	});
	
	
	$( "#slider2" ).slider({
		range: "min",
		value: 0,
		min: 0,
		max: 2000,
		slide: function( event, ui ) {
			$( "#slider_value2" ).html( ui.value );
			$( "#fee_gig" ).val( ui.value );
			$( "#slider1" ).slider('value',0);
		},
		change: function( event, ui ) {
			$( "#slider_value2" ).html( ui.value );
			$( "#fee_gig" ).val( ui.value );
		}
	});
	
	$( "#slider1" ).slider('value','<?php echo set_value('fee_hour',@$fee_hour); ?>');
	$( "#slider2" ).slider('value','<?php echo set_value('fee_gig',@$fee_gig); ?>');
	
	$('#profile_type').change(function() {
		if ($(this).val() == '') {
			$('#step2').slideUp('fast');
		} else {
			$('#step2').slideDown('fast');
		}
		$('.div_genre').hide();
		$('.option_col_x').hide();
		$('input.genre').attr('checked',false);
		$.uniform.update('input.genre');
		if($('.at_'+$('#profile_type').val()+ ' .option:last input').val()!='99999')
		{
			$('.genboxdivother').remove();
			$('<div class="option genboxdivother"><label><div class="checker" id="uniform-genre"><span><input type="checkbox" class="id_99999 genre other_gen_box" name="genre[]" id="genre" value="99999" style="opacity: 0;" onclick="return AddGenTextBox();"></span></div><strong>Other</strong></label><label><div id="gen_textbox" style="padding-top:20px; display:none" ><input type="text" name="other_gen" class="input1" id="other_gen" value="" style="width:50px;"/> </div></div>').insertAfter('.at_'+$('#profile_type').val()+ ' .option:last');			
		}
		$('.at_'+$(this).val()).show();
		//alert($('.at_'+$(this).val()).html());
		$('.div_genre').slideDown();
		updateUI();
	});
	
	$('.btn_add').live('click',function() {
		artist_id = '<?=$id?>';
		category_id = $('#category').val();
		instrument_id = $('#instrument').val();
		instrument_name = $('#instrument').val();
		title = $('#instrument option:selected').text();
		comment = $('#comment').val();
		ai_id = $('#ai_id').val();
		rowCount = $('.instrument_table tr').length;
		cssclass = '';
		if (rowCount%2 == 0) cssclass=' class="tr_even"';
		
		if (comment=='') {
		  $('#comment').addClass('input-error');
		  showErrorEx('All fields are required!');
		  return;
		}
		$('#comment').removeClass('input-error');
		
		$.post("<?=base_url()?>ajax/saveInstrument", { ai_id: ai_id, artist_id: artist_id, instrument_name: instrument_name, comment: comment },
		   function(data) {
			  if (ai_id) {
				$('#tr_'+ai_id).remove();
				$('.btn_add').html('Add');
			  }
			 $('.instrument_table > tbody:last').append('<tr'+cssclass+' id="tr_'+data+'" rel="'+category_id+'"><td rel="'+instrument_name+'">'+instrument_name+'</td><td>'+comment+'</td><td class="td_link"><a href="javascript:void(0)" rel="'+data+'" class="remove">remove</a> | <a href="javascript:void(0)" rel="'+data+'" class="edit">edit</a></td></tr>');
			 $('#comment').val('');
			 $('#instrument').val('');
			  $('#ai_id').val(0);
			  
		   });
		
	});
	
	
	
	
	$('.remove').live('click',function() {
		ai_id = $(this).attr('rel');
		elm = $(this);
		
		//if (!confirm('Are you sure you want to remove this Instrument?')) return;
		
		$.post("<?=base_url()?>ajax/removeInstrument", { ai_id: ai_id},
		   function(data) {
			 elm.closest('tr').fadeOut().delay(2000).remove();
		   });
	});
	
	$('.edit').live('click',function() {
		ai_id = $(this).attr('rel');
		elm = $(this).closest('tr');
		
		i_id = elm.find('td:first').attr('rel');
		c_id = elm.attr('rel');
		
		$('#category').val(c_id);
		$.uniform.update('#category');
		$('#category').change();

		$('#instrument').val(i_id);
		$.uniform.update('#instrument');
		$('#comment').val(elm.find('td:nth-child(2)').html());
		$('#ai_id').val($(this).attr('rel'));
		$('.btn_add').html('Update');
	});
	
	$('.specialization').change(function() {
		if ($('#specialization_14').attr('checked')) {
			//$('.div_genre').slideDown();
		} else {
			$('.div_genre').hide();
		}
	});
	
	$('.dj_combo').change(function() {
		if ($('#dj_combo_1').attr('checked')) {
			$('#div_instruments').slideDown();
			$('#div_dj').slideUp('fast');
		} else if($('#dj_combo_2').attr('checked')) {
			/*$('#div_instruments').slideUp('fast');
			$('#div_dj').slideDown();*/
			$('#div_instruments').slideDown();
			$('#div_dj').slideUp('fast');
		} else {
			$('#div_instruments').slideUp('fast');
			$('#div_dj').slideUp('fast');
		}
	});
	
	$('.equipment').change(function() {
		if ($('#equipment_0').attr('checked')) {
			$('#div_needed_equipment').slideDown();
		} else {
			$('#div_needed_equipment').slideUp('fast');
		}
		$('.needed_equipment').removeAttr('checked');
		$.uniform.update('.needed_equipment');
	});
	
	
	
	$('#category').change(function() {
		$.ajax({
		  type: "GET",
		  url: "<?=base_url()?>ajax/getInstrumentOptions/"+$(this).val(),
		  async: false
		}).done(function( msg ) {
		  $('#instrument').html(msg);
		  $.uniform.update('#instrument');
		});
	});
	
});

function updateUI() {
	opt = $('#profile_type').val();
	$('#div_gig').show();
	$('#div_specialization').hide();
	$('#div_equipment').hide();
	$('#instrument_heading').html('Instruments');
	$('.instrument-description').html('Description');
	$('#band_type_text').hide();
	$('#solo_combo_type_text').hide();
	$('#DJ_combo_type_text').hide();
	switch (opt) {
		case '1':
			$('#div_djcombo').slideDown();
			$('#div_instruments').hide();
			if ($('#dj_combo_1').attr('checked')) {
				$('#div_instruments').slideDown();
				$('#DJ_combo_type_heading').slideDown();
				$('#DJ_combo_type_text').slideDown();
			} else if ($('#dj_combo_2').attr('checked')) {
				$('#div_instruments').hide();
				$('#div_dj').slideDown('fast');
			}
			if ($('#equipment_0').attr('checked')) {
				$('#div_needed_equipment').slideDown();
			}
			$('#div_equipment').slideDown();
			$('#instrument_heading').hide();
			//alert($('.div_genre:last .').html())
			//$.uniform.update('input.genre');
			//$('.at_'+$('#profile_type').val()+ " .option_col:last").html(tempgens);
			break;
		case '3':
			$('#div_djcombo').hide();
			$('#div_instruments').slideDown();
			$('#solo_combo_type_heading').slideDown();
			$('#DJ_combo_type_heading').hide();
			$('#DJ_combo_type_text').hide();
			$('#div_dj').hide();
			$('#instrument_heading').show();
			$('#band_type_text').hide();
			$('#solo_combo_type_text').show();
			$('#DJ_combo_type_text').hide();
			break;
		case '7':
			$('#div_djcombo').hide();
			$('#div_instruments').slideDown();
			$('#DJ_combo_type_heading').hide();
			$('#DJ_combo_type_text').hide();
			$('#div_dj').hide();
			$('#instrument_heading').html('Line-up').show();
			$('#band_type_text').show();
			$('#solo_combo_type_text').hide();
			$('#DJ_combo_type_text').hide();
			$('.instrument-description').html('Player Name');
			break;
		case '9':
			$('#div_djcombo').hide();
			$('#div_instruments').slideDown();
			$('#DJ_combo_type_heading').hide();
			$('#DJ_combo_type_text').hide();
			$('#div_dj').hide();
			$('#instrument_heading').show();
			$('#div_gig').hide();
			$('#band_type_text').hide();
			$('#solo_combo_type_text').show();
			$('#DJ_combo_type_text').hide();
			break;
		case '10':
			$('#div_djcombo').hide();
			$('#div_instruments').hide();
			$('.div_genre').hide();
			$('#div_gig').hide();
			$('#div_specialization').slideDown();
			$('#div_equipment').hide();
			if ($('#specialization_14').attr('checked')) {
				//$('.div_genre').slideDown();
			}
			$('#div_dj').hide();
			$('#instrument_heading').show();
			if($('#div_specialization .option_col:last .options:last input').val()!='99999'){
			$('.specializationDivOther').remove();
			$('<div class="options specializationDivOther"><label><div class="checker" id="uniform-specialization-n"><span><input type="checkbox" class="other_specialization_box" name="specialization_arr[]"  value="99999" style="opacity: 0;" onclick="return AddspecializationTextBox();"></span></div><strong>Other</strong></label><div id="specialization_textbox" style="padding-top:20px; display:none" ><input type="text" name="other_specialization" class="input1" id="other_specialization" value="" style="width:50px;"/> </div></div>').insertAfter('#div_specialization .option_col:last .options:last');
		}
			break;	
	}
	if($('.at_'+$('#profile_type').val()+ ' .option:last input').val()!='99999')
	{
		$('.genboxdivother').remove();
		$('<div class="option genboxdivother"><label><div class="checker" id="uniform-genre"><span><input type="checkbox" class="id_99999 genre other_gen_box" name="genre[]" id="genre" value="99999" style="opacity: 0;" onclick="return AddGenTextBox();"></span></div><strong>Other</strong></label><div id="gen_textbox" style="padding-top:20px; display:none" ><input type="text" name="other_gen" class="input1" id="other_gen" value="" style="width:50px;"/> </div></div>').insertAfter('.at_'+$('#profile_type').val()+ ' .option:last');			
	}
	//alert($('#div_gig .options:last').html());	
	if($('#div_gig .options:last input').val()!='99999'){
		$('.gigboxdivother').remove();
		$('<div class="options gigboxdivother"><label><div class="checker" id="uniform-undefined"><span><input type="checkbox" class="other_gig_box" name="gigs_arr[]"  value="99999" style="opacity: 0;" onclick="return AddGigTextBox();"></span></div><strong>Other</strong></label><div id="gig_textbox" style="padding-top:20px; display:none" ><input type="text" name="other_gig" class="input1" id="other_gig" value="" style="width:50px;"/> </div></div>').insertAfter('#div_gig .options:last');
	}

}

function AddGenTextBox()
{
	$(".other_gen_box").toggle(this.checked);
	$('.at_'+$('#profile_type').val()+ ' .option:last span').toggleClass("checked");
	$('#gen_textbox').toggle();
}
function AddspecializationTextBox()
{
	$(".other_specialization_box").toggle(this.checked);
	$('#div_specialization .option_col:last .options:last span').toggleClass("checked");
	$('#specialization_textbox').toggle();
}
function AddGigTextBox()
{
	$(".other_gig_box").toggle(this.checked);
	$('#div_gig .options:last span').toggleClass("checked");
	$('#gig_textbox').toggle();
}
function showNeedEquNo(Id)
{
	if($('#needed_equipment_1').is(':checked')  || $('#needed_equipment_3').is(':checked') ){

		$('#need_equ_no_div').show();
		
	}else{
		$('#need_equ_no_div').hide();
	}	
	
	if(Id=='0')
	{
		if($('#needed_equipment_1').is(':checked'))
		{	
			$('#CDJS_textbox').show();	
		}else
		{
			$('#CDJS_textbox').hide();
		}
	}
	else
	{
		if($('#needed_equipment_3').is(':checked'))
		{
			
			$('#vinyl_textbox').show();	
		}
		else
		{
			$('#vinyl_textbox').hide();
		}
	}
	
}
showNeedEquNo(0);
</script>	