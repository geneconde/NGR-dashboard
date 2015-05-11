	$(document).ready(function() {	
		var cbs = $('#language_form input[type=checkbox]');	
		
		$('#check-all').click(function() {
			//var cbs = $('#language_form input[type=checkbox]');	
			var rbs = $('#language_form input[type=radio]');				
			if($(this).is(':checked')) {
				cbs.each(function() {
					$(this).prop('checked', true);
					rbs.each(function (){
						$(this).attr('disabled', false);
						$('#locale_1').prop('checked', true);
					});
				});
			} else {
				cbs.each(function() {
					$(this).prop('checked', false);
					rbs.each(function (){
						$(this).attr('disabled', true);
						$(this).attr('checked', false);
					});
				});
			}
		});
		
		cbs.click(function () {
			var cbx = $(this);
			var check = false;
			var radios = [];
			
			if(cbx.is(':checked')) {
				
				cbx.parent().parent().find('input[type=radio]').attr('disabled', false);
				
				cbs.each(function() {
					var cb = $(this);
					var rb = cb.parent().parent().find('input[type=radio]');
					
					var tbody = cb.parent().parent().parent().find('input[type=radio]');
					
					tbody.each(function() {
						if($(this).is(':checked')) {
							check = true;
						}
					});
					
					// radios.each(function() {
						// if($(this).is(':checked')) check = true;
					// });
					
					if(cb.is(':checked') && !check) {		
						rb.prop('checked', true);
						check = true;
					}
				});
			
			} else {
				cbx.parent().parent().find('input[type=radio]').attr('disabled', true);
				cbx.parent().parent().find('input[type=radio]').prop('checked', false);
			}
			
		});
		
		if($('#lang_1').is(':checked')){
			$('#locale_1').attr('disabled', false);
		} else {
			$('#locale_1').attr('disabled', true);
		}
		if($('#lang_2').is(':checked')){
			$('#locale_2').attr('disabled', false);
		} else {
			$('#locale_2').attr('disabled', true);
		}
		if($('#lang_3').is(':checked')){
			$('#locale_3').attr('disabled', false);
		} else {
			$('#locale_3').attr('disabled', true);
		}
		if($('#lang_4').is(':checked')){
			$('#locale_4').attr('disabled', false);
		} else {
			$('#locale_4').attr('disabled', true);
		}
		
		/*
		$('#lang_1').click(function(){
			if($(this).is(':checked')){
				$('#locale_1').attr('disabled', false);
				$('#locale_1').prop('checked', true);
			} else {
				$('#locale_1').attr('disabled', true);
				$('#locale_1').prop('checked', false);
			}
		});
		
		$('#lang_2').click(function(){
			if($(this).is(':checked')){
				$('#locale_2').attr('disabled', false);
				$('#locale_2').prop('checked', true);
			} else {
				$('#locale_2').attr('disabled', true);
				$('#locale_2').prop('checked', false);
			}
		});
		
		$('#lang_3').click(function(){
			if($(this).is(':checked')){
				$('#locale_3').attr('disabled', false);
				$('#locale_3').prop('checked', true);
			} else {
				$('#locale_3').attr('disabled', true);
				$('#locale_3').prop('checked', false);
			}
		});
		
		$('#lang_4').click(function(){
			if($(this).is(':checked')){
				$('#locale_4').attr('disabled', false);
				$('#locale_4').prop('checked', true);
			} else {
				$('#locale_4').attr('disabled', true);
				$('#locale_4').prop('checked', false);
			}
		});
		*/
		
	});