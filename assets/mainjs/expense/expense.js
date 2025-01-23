$(document).ready(function(){
	expense_list();
	var table;
	function expense_list(){
		table = $('#expense').DataTable({
			responsive: true,
			// buttons: [
			// 	{ extend: 'print', className: 'btn btn-default btn-sm' },
			// 	{ extend: 'csv', className: 'btn btn-default btn-sm' }
			// ],
	    	"serverSide": true,
			//"stateSave": true,
			"paging": true,
	    	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	    	"order": [[ 0, "desc" ]],
			// "dom": "<'row mb-3'<'col-md-4 mb-3 mb-md-0'l><'col-md-8 text-right'<'d-flex justify-content-end'f<'ms-2'B>>>>t<'row align-items-center'<'mr-auto col-md-6 mb-3 mb-md-0 mt-n2 'i><'mb-0 col-md-6'p>>",
			"pageLength": 25,	
			"ordering"   :false,
	        "processing": true,
	        "ajax":{
		     	"url": base +"/expense/expense_list",
		     	"dataType": "json",
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "sr" },
		        { "data": "month_year" },
		        { "data": "total" },
		        { "data": "created_by" },
		        { "data": "created_date" },
		        { "data": "status" },
		        { "data": "Action" },
		    ],
	    	"columnDefs": [
	        	{ targets: 0, width: '150px' },
	        	{ targets: 1, width: '200px' },
	        	{ targets: 0, width: '200px' },
	        	{ targets: 3, width: '200px' },
	        	{ targets: 4, width: '200px' },
	        	{ targets: 5, width: '200px' },
	        	{ targets: 6, width: '200px' },
	        ]
	    });
	}

	$(document).on('click', '#is_approved', function(){
		var id = $(this).attr('data-id');
		console.log(id);
		if ($(this).is(":checked")) {
			var is_approved = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_approved = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {id: id, is_approved: is_approved};
		$.ajax({
			url: base + "/expense/expense_status_update",
			type: "POST",
			data: mydata,        
			success: function(data) {
			    if (data.success) {
				    Swal.fire('', data.msg, 'success');
				}
			}
		});	
	});

	$(document).on('click', '.delete', function(){

		var expense_id = $(this).data('expense_id');


		Swal.fire({
		  title: 'Are you sure you want to delete this expense',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, do it!'
		}).then((result) => {
		    if (result.isConfirmed) {

		        $.ajax({
		            url: base + "/expense/delete",
		            type: "POST",
		            data: {
		                expense_id: expense_id,
		            },        
		            success: function(data) {
		                if (data.success) {
		                	Swal.fire('', 'Expense deleted successfully!', 'success');
		                    var table = $('#expense').dataTable();
		                    table.fnDestroy();
		                    expense_list();

		                } else {
		                    Swal.fire('', 'Something went wrong! Please try later', 'error');
		                }
		            }
		        }); 

		    }
		})
	})

});