<style>
.error {
	border: 1px solid red;
}
#prev1,
#next1	{
	
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	color: #222;
	display: block;
	font: bold 14px 'Droid Sans', Arial, Helvetica, sans-serif;
	line-height: 30px;
	position: absolute;
	text-align: center;
	text-decoration: none;
	top: 11px;
	width: 146px;
	height: 27px;	
}
#prev1	{
	background: url(../images/buttons-bg2b.gif) no-repeat;
	left: 29px;
}
#next1	{
	background: url(../images/buttons-bg2.gif) no-repeat;
	right: 29px;
}
#prev1 span,
#next1 span	{ font-size: 17px; }
</style>
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