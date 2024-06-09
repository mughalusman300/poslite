$(document).ready(function(){

	$(document).on('click', '.generate_report', function(){
		var validate = checkValidation('#report');
		if (validate) {
			$('#report').submit();
		}
	});

});