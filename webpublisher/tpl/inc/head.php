<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $lang[0] ?></title>
<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen,projection" />
<? if(isset($loadMCE)){ ?>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
<!--
tinyMCE.init({
	mode: "specific_textareas",
	editor_selector : "tinymce",
	theme: "advanced",
	plugins : "advimage, table, inlinepopups",
	content_css : "tiny_mce/custom_css/webskin.css?q=" + new Date().getTime(),
	doctype: '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
	fix_list_elements: true,
	width: "100%",
	theme_advanced_blockformats: "p,h2,h3,h4,h5,h6",
	theme_advanced_toolbar_location: "top",
	theme_advanced_toolbar_align: "left",
	theme_advanced_buttons1: "formatselect, styleselect,fontsizeselect,  bold, italic, strikethrough, justifyleft, justifycenter, justifyright, justifyfull, bullist, sub, image, link, unlink, forecolor, charmap, cleanup, code, removeformat,separator, tablecontrols",
	theme_advanced_buttons2: ""
});
-->
</script>
<? } ?>
<script type="text/javascript">
<!--
function keepAlive() {
    var imgAlive = new Image();
    var date = new Date();
    imgAlive.src = 'nonexistentfile.php?date=' + date;
}

setInterval("keepAlive()", 60*1000);
-->
</script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/ui.tabs.min.js"></script>
<script type="text/javascript" src="js/ums.js"></script>
<script type="text/javascript" src="js/interface.js"></script>
<script type="text/javascript" src="js/ajaxfileupload.js"></script>


</head>
