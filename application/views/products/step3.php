<?php //print_r($shoppingcart) ?>
<form action="" method="post" class="uniform">
<div class="box-container">
	<div class="box-content">
		<div class="products">
			<?php include_once "product_body.php"; ?>
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
				$('#model_label').html($(this).val() + ' ');
		});
		$('#size').change(function (e) {
			if ($(this).val() != "")
				$('#size_label').html($(this).val() + ' ');			
		});
		
						
		$('#category').val('<?php echo !isset($shoppingcart['category']) ? set_value('category',@$category) : $shoppingcart['category'] ?>').change();
		$('#model').val('<?php echo !isset($shoppingcart['model']) ? set_value('model',@$model) : $shoppingcart['model'] ?>').change();
		$('#size').val('<?php echo !isset($shoppingcart['size']) ? set_value('size',@$size) : $shoppingcart['size'] ?>').change();
		
		$('#next-btn').click(function (e) {		    
			
			error = '';
			error += validate('category', 'Category');
			error += validate('model', 'Model');
			error += validate('size', 'Size');							
			
			if (error != '')
			{				 
				 $.floatingMessage(error, { height : 60, width:200,
				  time:3000  });  
				return false;
			}
				//parent.location.href = '<?= base_url() ?>register/step2';

        });		
	});
</script>
