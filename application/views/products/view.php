<style>
.image-container {
	float: left;
	margin: 12px;
	width: 400px;
	overflow: hidden;
}
.image-container img {
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
</style>
<div id="inner-content">
	<div id="main-content">
		<div class="image-container">
			<?php echo img('wpdata/images/'.$Model['images'][0]['id'].'-l.jpg');?>
		</div>
		<h2>Antionette Bedhead and Base</h2>
		<h3>$<?php echo number_format($Model['price']);?> AUD</h3>
		<div>
			<?php echo $Model['description'];?>
		</div>
		<div class="product-options">
			<?php echo form_open('products/index');?>
				<input type="hidden" name="model" value="<?php echo $Model['title'];?>" />
				<input type="hidden" name="size" value="Queen" />
				<input type="hidden" name="category" value="Bedding" />
				<button name="customize" class="btn options">Customize</button>
				<a href="#" class="options">Add to Favorites</a>
			</form>
		</div>
	</div>
</div>
<p>&nbsp;</p>