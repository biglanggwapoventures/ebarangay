(function($){
	$(document).ready(function(){	

		function enableModules(currentRole){
			if(currentRole === 'su'){
				$('input.disabled-type-superuser').attr('disabled', 'disabled').prop('checked', false);
			}else{
				$('input.disabled-type-superuser').removeAttr('disabled');
			}
		}

		enableModules($('select.role'). val());
		$('select.role').change(function(){
			enableModules($(this).val());
		});

	})
})(jQuery)