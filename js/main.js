
// For Input Forms

function clearText(srcObj){
if(srcObj.title == srcObj.value) srcObj.value = "";
}

function writeText(srcObj){
if(srcObj.value == "") srcObj.value = srcObj.title;
}



// Hover  

$(document).ready(function() {
	$('.sliderkit-panel').mouseenter(function() {
		$(this).find('.slide-hover').stop(true, true).animate({ opacity: 'toggle' });		  
	}).mouseleave(function() {
		$(this).find('.slide-hover').stop(true, true).animate({ opacity: 'toggle' });
	});					   
});



// TABS


$(document).ready(function() {
	//Default Action
	$(".tab-content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab-content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab-content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
});

// FETCH MODEL DETAILS

function fetch_model_details(item)
{
	title = $(item).val();
	jQuery.ajax({
		url: base_url + 'products/model_details',
		type: "POST",
		dataType: 'json',
		data: 'title='+title
	}).done(function(data){
		if(data.error === false)
		{
			$("#option-text-container").html(data.model.description);
		} else {
			$("#option-text-container").html('');
		}
	});
}