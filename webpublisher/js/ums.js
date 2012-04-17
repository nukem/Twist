function addLog(form) {

	var message = $('.message', form);

	if(message.is(':visible')) {
		message.stop().slideUp('fast');
	}
	$.ajax({

		url: 'ums_add_log.php',
		type: 'POST',
		data: form.serialize(),
		success: function (data) {
			if(data.success === true) {
				var date = new Date();
				var logDate = (date.getHours()) + ':' + date.getMinutes() + ' ' + date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
				var log = 
					'<div class="log-data">' + 
						'<div class="log-vitals">' + 
							'<div class="log-name">' + $('input[name=name]', form).val() + '</div>' + 
							'<div class="log-timestamp">' + logDate + '</div>' + 
						'</div>' + 
						'<div class="log-contents">' + 
							$('textarea[name=contents]', form).val().replace(/\n/g, '<br />') + 
						'</div>' + 
					'</div>';
				$('.previous-logs').prepend(log);

				form[0].reset();
			}
			message.html(data.message).stop().slideDown('fast');
			setTimeout(
				function () {
					if(message.is(':visible')) {
						message.stop().slideUp('fast');
					}
				}, 5000
			);
		},
		dataType: 'json'
	})


	return false;
	
}

function updateUser(form) {

	$.ajax({

		url: 'ums_update_details.php',
		type: 'POST',
		data: form.serialize(),
		success: function (data) {
			$('.message', form).html(data.message).slideDown('slow');
			setTimeout(function () {
				$(".message", form).slideUp("slow").html("")
			}, 2000);

			$('input[type=text]', form).each(function () {

				$('.' + $(this).attr('name')).text($(this).val());
				
			});
		},
		dataType: 'json'
	})


	return false;
}

function modifyComment(commentId) {

	$('.modify-blog-comment-' + commentId).slideDown('fast');
	//$('.blog-comment-' + commentId).slideUp('fast');
	return false;

}

function closeComment(commentId) {

	$('.modify-blog-comment-' + commentId).slideUp('fast');
	//$('.blog-comment-' + commentId).slideUp('fast');
	return false;

}

function saveCommentChanges(form) {
	$.ajax({

		url: 'blog_update_comment.php',
		type: 'POST',
		data: form.serialize(),
		success: function (data) {
			$('.message', form).html(data.message).slideDown('slow');
			$('.comment-' + data.recId).html(data.comment);
			setTimeout('$(".modify-blog-comment-" + ' + data.recId + ').slideUp("slow");', 2000);
		},
		dataType: 'json'
	})


	return false;

}

function bulkDeleter(parentId, label) {
	if(typeof(parentId) == 'undefined' || parentId == '') {
		alert('Please select a folder before proceeding.');
	} else {

		var confirmDelete = confirm('Are you sure that you wish to delete all the files in "' + label + '"');

		if(confirmDelete == true) {

			$.ajax({
				url: 'bulk_deleter.php',
				type: 'POST',
				data: 'parentid=' + parentId,
				success: function (data) {
					alert(data.message);
					//alert( data.count + ' images have been deleted from the database.');
					window.location.reload();
				},
				dataType: 'json'
			})
		}

	}
	return false;
}


$(document).ready( function () {

$('.tabs').each(function () {
$(this).tabs();
});

	$('.users table').each( function () {
	
		$("tr:nth-child(odd)", $(this)).addClass("odd");
		$("tr:nth-child(even)", $(this)).addClass("even");

	});

	$('.tabs table').each( function () {
	
		$("tr:nth-child(odd)", $(this)).addClass("odd");
		$("tr:nth-child(even)", $(this)).addClass("even");

	});

});
