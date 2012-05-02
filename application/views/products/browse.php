<style>
	.row {
		min-height: 280px;
	}
	.thumb-container {
		overflow: hidden;
		height: 180px;
		width: 240px;
		float: left;
		margin: 12px;
	}
	.thumb-container img {
		width: 100%;
	}
	
.options {
	border: none;
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
	width: 124px;
	height: 30px;
	text-align: center;
	margin-top: 6px;
}
#content {

}
</style>
<div id="inner-content">
	<div id="main-content" style="overflow:hidden;height:400px;">
		<h3>Product Listing</h3>
		
		<div id="sidebar">
			<div class="sidenav">
				<h4>Category</h4>
				<ul>
					<li><a href="#">Bedding</a></li>
					<li><a href="#">Furniture</a></li>
				</ul>
			</div>
		</div>
		
		<div id="content">
		
<?php foreach($models as $model):?>		
			<div class="row">
				<div class="thumb-container">
					<?php if(!empty($model['Images'][0]['title'])):?>
					<img src="/images-raw/<?php echo $model['Images'][0]['title'];?>.jpg" />
					<?php endif;?>
				</div>
				<h3 style="margin-bottom:4px;"><?php echo $model['title']?></h3>
				<div>
					<?php echo $model['description'];?>
				</div>
				<h4>$<?php echo number_format($model['price']);?> AUD</h4>
				<div class="product-options">
					<?php echo form_open('products/index');?>
					<input type="hidden" name="model" value="<?php echo $model['title'];?>" />
					<input type="hidden" name="size" value="Queen" />
					<input type="hidden" name="category" value="Bedding" />
					<button name="customize" class="btn options">Customize</button>
					<?php echo anchor('products/view/'.$model['title'], 'Product Details', 'class="options"');?>
					<a href="#" class="options">Add to Favorites</a>
					</form>
				</div>
			</div>
<?php endforeach;?>
		
		</div>
	</div>
	<p style="clear:both;">&nbsp;</p>
</div>

<p>&nbsp;</p>

<script type="text/javascript" defer="defer">
(function(){
	
})();

</script>