$(document).ready(function(){
	var table;
	saleList();

	function saleList() {
		var start_date = $('.start_date').val();
		var end_date = $('.end_date').val();
		table = $('#sales_table').DataTable({
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
		     	"url": base +"/sales/saleList",
		     	"dataType": "json",
		     	"data":{start_date : start_date, end_date : end_date},
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "sr" },
		        { "data": "invoice_code" },
		        { "data": "invoice_date" },
		        { "data": "invoice_discount" },
		        { "data": "invoice_total" },
		        { "data": "invoice_net" },
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

	$(document).on('click', '.generate_sales', function(){
		var validate = checkValidation('#sales');
		if (validate) {
			table.destroy();
			saleList();
		}
	});

	$(document).on('click', '.return-item', function(){
		var invoice_code = $(this).attr('data-invoice_code');
		var mydata = {invoice_code: invoice_code};
		$.ajax({
			url: base + "/sales/get_invoice_detail",
			type: "POST",
			data: mydata,        
			success: function(data) {
			    if (data.success) {
			    	$('.response').html(data.html);
			    	$('.return-item-modal').modal('show');
				}
			}
		});	
	});
	$(document).on('blur', '.return_qty', function(){
		var return_qty = parseInt($(this).val());
		if(return_qty) {
				var qty = parseInt($(this).closest('tr').find('.qty').val());
				console.log(qty);
				if (return_qty > qty) {
					Swal.fire('', 'Return Qty should not be greater than sale qty', 'error');
					$(this).addClass('is-invalid');
					$(this).val('');
				}
		}
	});



	$(document).on('click', '.return', function(){
		var val = '';
		$("input[name*='return_qty']").each(function() {
			return_qty = $(this).val();
			if (return_qty != '') {
				val = return_qty;
			}
		});

		if (val == '') {
			Swal.fire('', 'Atleast one item should be return to continue this request', 'error');
			return false;
		}

		Swal.fire({
		  title: 'Are you sure?',
		  text: "You want to return Items!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes!'
		}).then((result) => {
		  	if (result.isConfirmed) {

				var formdata = new FormData( $("#return_form")[0] );
			$.ajax({
				"url": base +"/sales/return",
				type : 'post',
				'async': true,
				'processData': false,  // tell jQuery not to process the data
				'contentType': false,  // tell jQuery not to set contentType
				data : formdata,
				success : function(data) {
		  				if(data.success) {
		  					Swal.fire('', data.msg, 'success');
		  					$('.return-item-modal').modal('hide');
		  					// saleList();
		  					table.ajax.reload()
		  					if (data.return_all) {

		  					}
		  				}
	  			},
			});
			}
		})

	});

	$(document).on('click', '.return-full-invoice', function(){

		Swal.fire({
		  title: 'Are you sure?',
		  text: "You want to return all items!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes!'
		}).then((result) => {
		  	if (result.isConfirmed) {

		  		$("input[name*='return_qty']").each(function() {
		  			var qty  = $(this).closest('tr').find('.qty').val();
		  			$(this).val(qty);
		  		});

				var formdata = new FormData( $("#return_form")[0] );
				$.ajax({
					"url": base +"/sales/return",
					type : 'post',
					'async': true,
					'processData': false,  // tell jQuery not to process the data
					'contentType': false,  // tell jQuery not to set contentType
					data : formdata,
					success : function(data) {
		  				if(data.success) {
		  					Swal.fire('', data.msg, 'success');
		  					$('.return-item-modal').modal('hide');
		  					table.ajax.reload()
		  				}
		  			},
				});
			}
		})

	});

});