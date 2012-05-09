<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
  <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="ProjectName" />
<meta name="keywords" content="ProjectName" />
<title>Twist Lifestyle</title>
<link href="<?= base_url() ?>css/reset.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?= base_url() ?>css/style.css?t=<?php echo time();?>" rel="stylesheet" type="text/css" media="screen" />
<link href="<?= base_url() ?>css/sliderkit-core.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?= base_url() ?>css/font/stylesheet.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?= base_url() ?>css/jquery-ui-1.8.18.custom.css" type="text/css" rel="stylesheet" media="screen" />
<!--[if lte IE 8]>
	<link href="css/ie.css" rel="stylesheet" type="text/css" media="screen" />
<![endif]-->
<!--  script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js" type="text/javascript"></script -->
<script src="<?php echo base_url();?>js/jquery-1.7.1.min.js" type="text/javascript"></script>

<script src="<?= base_url() ?>js/main.js?t=<?php echo time();?>" type="text/javascript"></script>
<script src="<?= base_url() ?>js/jquery.sliderkit.1.8.js" type="text/javascript"></script>
<script src="<?= base_url() ?>js/jquery.easing.1.3.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>js/jquery.tinyscrollbar.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url() ?>js/script.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.floatingmessage.js"></script>
<script type="text/javascript">
var base_url = '<?php echo base_url();?>';

	$(window).load(function(){ 			
		$(".photoslider-mini").sliderkit({
			autospeed:5000,
			circular:true,
			panelfx:"sliding",
			panelfxspeed:1400,
			panelfxeasing:"easeInOutExpo"
		});
	});	
</script>
</head>
  <body>
    <div id="outer-wrapper">

      <?php $this->load->view('header'); ?>
		<div id="mainbody">
				  <?php $this->load->view($main_content); ?>
		</div><!-- end mainbody -->
      
	  <?php $this->load->view('footer'); ?>

    </div>  
    <!--[if lt IE 7 ]>
    <script src="<?= base_url() ?>js/libs/dd_belatedpng.js"></script>
    <script> DD_belatedPNG.fix('img, .png_bg');</script>
    <![endif]-->
    <script>
     
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25469551-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
    </script>
    <?
    $Errors = $this->session->flashdata('error');
    $Messages = $this->session->flashdata('message');
    ?>

    <script type="text/javascript">
      $(document.body).ready(function(){
<? if ($Errors) : ?>	
          var Errmsg = '<div class="ui-widget"><div style="padding: 0pt 0.7em;" class="ui-state-error ui-corner-all flash"> <p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span> <strong>Error:</strong> <?= $Errors ?></p></div></div>';
          $.floatingMessage(Errmsg ,{width : 500 });
<? endif; ?>
<? if ($Messages) : ?>
          var msg = '<div class="ui-widget"><div style="margin-top: 20px; padding: 0pt 0.7em;" class="ui-state-highlight ui-corner-all flash"> <p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span><strong>Success!</strong> <?= $Messages ?></p></div></div>';
          $.floatingMessage(msg ,{width : 500, time : 5000 });
<? endif; ?>		
      });
    </script>
  </body>
</html>