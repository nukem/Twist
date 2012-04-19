<style>
.cart-icon-link:hover,
.cart-icon-link{
	text-decoration: none;
	color: white;
}

</style>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="header-container">
	<div id="header">
		<h1 id="logo"><a href="index.html"><img src="<?= base_url() ?>images/logo.png" alt="Twist Lifestyle" width="230" height="87" /></a></h1>
		<div id="tagline">Bespoke homewares, bedheads, chairs &amp; manchester,<br />sophisticated furniture to suit your life style</div>
		<div id="nav">

					
			<ul>
				<li><a href="<?=base_url()?>">HOME</a></li>
				<li><a href="<?=base_url()?>">CATALOGUE</a></li>
				<li><a href="<?=base_url()?>products">PRODUCTS</a></li>
				<li><a href="<?=base_url()?>general_content.html">TESTIMONIALS</a></li>
				<li><a href="<?=base_url()?>#">FABRIC</a></li>
				<li><a href="<?=base_url()?>#">WHOLESALE</a></li>
				<li><a href="<?=base_url()?>#">FAVORITES</a></li>
			</ul>
			

				
			<div class="search">
				<form action="#" method="post">
					<input type="submit" name="" class="submit-btn" value="" />
					<input type="text" name="" class="text-box" value="Search..." title="Search..." onblur="writeText(this);" onfocus="clearText(this);" />
				</form>
			</div>

			<div class="shopping-cart-info">
				<a href="/products/checkout" class="cart-icon-link"><i class="shopping-cart-icon"></i><span><?php echo (isset($_SESSION['shopping_cart_count']))?$_SESSION['shopping_cart_count']:'&nbsp;';?></span></a>
			</div>
			
		</div>
	</div>
</div><!-- end header -->
