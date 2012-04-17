var formList = $('.form-validation');

function addFormElement() {
	$('.clone').clone().addClass('new-clone').attr('id', 'pews').appendTo('.form-elements');
	$('.form-elements').SortableAddItem(document.getElementById('pews'));
	$('.new-clone').slideDown('fast').removeClass('new-clone').removeClass('clone').attr('id', '');

	return false;

}

function removeFormElement(btn) {
	console.log(btn);
	var scope = btn.parents('li.form-item');
	console.log(scope);
	var idVal = $('input[name=id]', scope).val()
	if(idVal == '' || typeof(idVal) == 'undefined') {
		scope.slideUp('slow', function () {
			scope.remove()
		})
	} else {
		$.ajax({
			url: 'form_remove_item.php',
			type: 'POST',
			data: 'id=' + $('input[name=id]', scope).val(),
			success: function(data) {
				scope.slideUp('slow', function () {
					scope.remove()
				})
			},
			dataType: 'json'
		})
	}
}

function saveFormElement(btn) {

	var scope = btn.parents('li.form-item');
	var idVal = $('input[name=id]', scope).val()
	$.ajax({
		url: 'form_save_item.php',
		type: 'POST',
		data: 
		'label=' + $('input[name=label]', scope).val() + '&' +
		'type=' + $('select[name=type]', scope).val() + '&' +
		'required=' + $('select[name=required]', scope).val() + '&' +
		'valid_email=' + $('select[name=valid_email]', scope).val() + '&' +
		'values=' + $('input[name=values]', scope).val() + '&' +
		'id=' + $('input[name=id]', scope).val() + '&' +
		'parent=' + $('input[name=parent]', scope).val() + '&' +
		'position=' + $('input[name=form_position]', scope).val(),
		success: function(data) {
			$('input[name=id]').val(data.id);
		},
		dataType: 'json'
	})
	return false;

}

function saveFormOrder() {

	var formOrder = new Array();
	var formData = new Array;
	var i = 0;
	$('.form-item:visible').each(function () {

		$('input[name=form_position]', this).val($('.form-elements li:visible').index($(this)));
		formData[i] = $('input[name=id]', this).val() + '=' + $('.form-elements li:visible').index($(this));
		i++;

	});

	var formDataString = formData.join('&');
	
	$.ajax({
		url: 'form_save_order.php',
		type: 'POST',
		data: formDataString,
		success: function(data) {
			$('.save-order').hide();
		},
		dataType: 'json'
	})

	return false;
}

$(function () {

	$('.form-elements').Sortable({
		accept: 'form-item',
		handle: '.form-drag-handle',
		onStop: function() {
          $('.save-order').show();
        }
		
	});

});
