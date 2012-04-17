
<div style="float:right;">
<div class="form_item alert_gig"></div>
<div class="form_item"><label>Gig Name</label></div>
<?php $gig_list = array('Max');?>
<div class="form_item simu_select1">
	<?=form_dropdown('gig_id', $gig_list, '' , 'id=gig_list')?>
</div>
<?php $order = array(1,2,3);?>
<div class="form_item"><label>Artist Position</label></div>
<div class="form_item simu_select3">
	<?=form_dropdown('order', $order, '' , 'id=order')?>
</div>

<input type="submit" value="Book" class="input_continue" name="book" style="width: 90px !important;">
</div>
<script>
$(function(){
	$("select, input:checkbox, input:radio, input:file").uniform();
	$('.input_continue').click(function(){
		$('.alert_gig').empty().text('Loading...');
		$.post('<?=base_url()?>ajax/offer_update',{'order':$('#order').val(),'gig_id':$('#gig_list').val(),'artist_id':'<?=$artist_id?>'},function(data){
			// $('.alert_gig').text('Booked');
			
		});
	});
});

</script>
