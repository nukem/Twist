// window.onresize causes IE6 to hang (due to an infinite loop).
// The following was taken from http://remysharp.com/2008/05/15/windowonresize-hangs-ie6-and-ie7/#comment-93255

function resize_viewport() {
	$.event.remove( this, "resize", DP_position);

	DP_position();

	// do what you need to do
	$.event.add( this, "resize", resize_viewport);
}

function DP_show(url){
	var oh, st = 0;
	st = getScrollTop();
	$("body").append('<div id="DP_overlay"></div><div id="DP_show"><div id="DP_waiting"><img src="images/ajax-loader.gif" alt=" " /></div><div id="DP_content" style="display: none;"></div></div>');
	oh = parseInt($(document).height());
	$("#DP_overlay").css("height", oh + st + "px");
	
	DP_position(false, oh);
	
	$("#DP_overlay").fadeIn(500, function(){
		$("#DP_show").fadeIn(500, function(){
			$("#DP_overlay").click(DP_remove);
			DP_dataload(url);
		});
	});
	
	// this is borrowed from thickbox
	document.onkeyup = function(e){   
		if (e == null) { // ie
			keycode = event.keyCode;
		} else { // mozilla
			keycode = e.which;
		}
		if(keycode == 27){ // close
			DP_remove();
		}  
	}
	
	//window.onresize = DP_position;
	resize_viewport();
	return false;
}

function DP_dataload(url){
	var params = {'ajax': true};
	$.post(url, 
	  params, 
	  function(data){
		$("#DP_show").slideUp(300, function(){
				$('#DP_waiting').remove();
				$("#DP_content").append(data).show();
				$("#DP_show").slideDown(550, function() {
					DP_init();
				});
			});
		});
}

function DP_init() {

	if($('.color').size() > 0) {
		$('.color').ColorPicker(
			{
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).val(hex);
					$(el).ColorPickerHide();
				},
				onBeforeShow: function () {
					$(this).ColorPickerSetColor(this.value);
				}
			}
		);
	}
}


function DP_remove(){
	$("#DP_show").fadeOut("fast", function(){
		$(this).remove();
		$("#DP_overlay").fadeOut("fast", function(){
			$(this).remove();
		});
	});
	
	document.onkeyup = "";
	window.onresize = "";
}

function DP_position(animateMove, windowHeight){
	var anim = true;
	if(animateMove == false){
		anim = false;
	}
	var  window_height, window_width, show_width, st;
	if(window.innerWidth){
		window_width = window.innerWidth;
		window_height = window.innerHeight;
	}else if(document.body.offsetWidth){
		window_width = document.body.offsetWidth;
		window_height = document.body.offsetHeight;
	}
	st = getScrollTop();
	if(typeof (windowHeight) != 'undefined' && window_height > windowHeight){
		$("#DP_overlay").animate({height: st + window_height + 'px'}, 'normal');
	}
	show_width = $("#DP_show").width();
	if(anim == true){
		$("#DP_show").animate({marginLeft: parseInt(((window_width-show_width) / 2),10) + 'px', top: st + 50 + "px"}, 'normal');
	}else{
		$("#DP_show").css({marginLeft: parseInt(((window_width-show_width) / 2),10) + 'px', top: st + 50 + "px"});
	}
}

function getScrollTop(){
	var st=0;
	if (document.documentElement && document.documentElement.scrollTop){
	  st = document.documentElement.scrollTop;
	}else if (document.body && document.body.scrollTop){
	  st = document.body.scrollTop;
	}else if (window.pageYOffset) {
	  st = window.pageYOffset;
	}
	return st;
}
