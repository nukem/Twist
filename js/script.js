
	function compare(ctrl_name, ctrl_name2, text)
	{
	
		var ctrl = $('#' + ctrl_name);
		var ctrl2 = $('#' + ctrl_name2);
		
		if (ctrl.val() != ctrl2.val())
		{
			ctrl.addClass('error');
			ctrl2.addClass('error');
			return text + ' does not match.' + '<br/>';
		}		
		else
		{
			ctrl.removeClass('error');
			ctrl2.removeClass('error');
			return '';
		}
		return '';
	}
	
	function validateEmail(email, text) { 
		var ctrl = $('#' + email);
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		
		if (!re.test(ctrl.val()))
		{						
			ctrl.addClass('error');
			return text + ' is not valid email' + '<br/>'
		}
		else
		{
			ctrl.removeClass('error');
			return '';
		}
	} 

	function validate(ctrl_name, text)
	{
		var ctrl = $('#' + ctrl_name);
		
		
		if (ctrl.val() == '')
		{			
			$("#select" + ctrl_name).removeClass('select').addClass('select-err');							
			ctrl.addClass('error');
			return text + ' is required' + '<br/>'
		}
		else
		{
			$("#select" + ctrl_name).removeClass('select-err').addClass('select');				
			ctrl.removeClass('error');
			return '';
		}
	}