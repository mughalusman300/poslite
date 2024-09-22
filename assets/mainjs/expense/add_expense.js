$(document).ready(function() {

	// Initialize the datepicker
    $('#month_year').datepicker({
        format: 'mm-yyyy',
        autoclose: true,
        viewMode: 'months', // Set view mode to months
        minViewMode: 'months' // Ensure only months are selectable
    });
	$('.date').datepicker({
        format: 'dd-mm-yyyy',  // Date format (you can adjust this)
        todayHighlight: true,  // Highlight today's date
        autoclose: true,       // Close the datepicker after selecting a date
    });

	// On focus (click) on the input, reset the calendar to the current month
    $('.date').on('focus', function() {
        $(this).datepicker('setStartDate', new Date(now.getFullYear(), now.getMonth(), 1)); // Reset to current month          
    });
    function getMonthName(monthNumber) {
        // Array of month names, starting from January
        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        
        // Since monthNumber is 1-based, subtract 1 to get the correct index
        return monthNames[monthNumber - 1];
    }

    $(".date").on('change', function() {
    	var month_year = $('.month_year').val();
    	if(month_year == '') {
    		Swal.fire('Alert', 'Please select expense month first', 'error');
    		$(this).val('');
    		$('.month_year').addClass('is-invalid');
    		return false;
    	} else {
			var parts = month_year.split("-");
	        var formattedDate = parts[1] + "-" + parts[0] + "-01"; // 'yyyy-mm-dd' format
    		var inputDate = new Date(formattedDate);
    		var selectedMonth = inputDate.getMonth() + 1;  // Get month (0-11)
    		var selectedYear = inputDate.getFullYear(); 

    		var inputRowDate = $(this).val();
    		var parts = inputRowDate.split("-");
            var formattedDate = parts[2] + "-" + parts[1] + "-" + parts[0]; // 'yyyy-mm-dd' format

    		var inputRowDate = new Date(formattedDate);
    		var selectedRowMonth = inputRowDate.getMonth() + 1;  // Get month (0-11)
    		var selectedRowYear = inputRowDate.getFullYear();  // Get year

			selectedRowMonthName = getMonthName(selectedRowMonth);
			selectedMonthName = getMonthName(selectedMonth);

    		if(selectedRowMonth != selectedMonth) {
    			Swal.fire('Alert', 'Expense month selected as '+selectedMonthName+' Please select '+selectedMonthName+' month date', 'error');
    			$(this).val('');
    			$(this).addClass('is-invalid');
    			return false;

    		} else if(selectedRowYear != selectedYear) {
    			Swal.fire('Alert', 'Expense year selected as '+selectedYear+' Please select '+selectedYear+' year date', 'error');
    			$(this).val('');
    			$(this).addClass('is-invalid');
    			return false;
    		}
    	}

    });


	$(document).on('click', '.add-more', function(){	
        var html = $('.extra-row').html();
		$('.parent-row').append(html);
			$('.date').datepicker({
		        format: 'dd-mm-yyyy',  // Date format (you can adjust this)
		        todayHighlight: true,  // Highlight today's date
		        autoclose: true,       // Close the datepicker after selecting a date
		    });
	});
	$(document).on('click', '.remove-row', function(){	
        $(this).closest('.main-row').remove();
	});

	$(document).on('click', '.submit', function(e){	
		var validate = checkValidation('#add_expense');
		if (validate) {

		} else {
			e.preventDefault();
		}
	});
})