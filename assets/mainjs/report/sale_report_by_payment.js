$(document).ready(function(){

	$('.start_date').datepicker({
        format: 'dd-mm-yyyy',  // Date format (you can adjust this)
        todayHighlight: true,  // Highlight today's date
        autoclose: true,       // Close the datepicker after selecting a date
    });

	$('.end_date').datepicker({
        format: 'dd-mm-yyyy',  // Date format (you can adjust this)
        todayHighlight: true,  // Highlight today's date
        autoclose: true,       // Close the datepicker after selecting a date
    });
	    
	$(document).on('click', '.generate_report', function(){
		var validate = checkValidation('#report');
		if (validate) {
			$('#report').submit();
		}
	});

});