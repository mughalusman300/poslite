$(document).ready(function(){
	var status = $('.status').val();
	payableList('', status);

	function payableList(search =''){
		var table = $('#payable').DataTable({
			"rowCallback": function( row, data ) {
				$('td:eq(0)', row).addClass('align-middle');
				$('td:eq(1)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(3)', row).addClass('align-middle');
				$('td:eq(4)', row).addClass('align-middle');
			},
			responsive: false,
			// buttons: [
			// 	{ extend: 'print', className: 'btn btn-default btn-sm' },
			// 	{ extend: 'csv', className: 'btn btn-default btn-sm' }
			// ],
			"searching": false,
	    	"serverSide": true,
			//"stateSave": true,
			"paging": true,
			"lengthChange": false,
	    	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	    	"order": [[ 0, "desc" ]],
			"pageLength": 25,	
			"ordering"   :false,
	        "processing": true,
	        "ajax":{
		     	"url": base +"/payable/payableList",
		     	"dataType": "json",
		        "data":{ search: search, status: status },
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "account_name" },
		        { "data": "amount" },
		        { "data": "paid_amount" },
		        { "data": "pending_amount" },
		        { "data": "payable_desc" },
		        { "data": "added_by" },
		        { "data": "status" },
		        { "data": "action" },
		    ],
	    	"columnDefs": [
	        	{ targets: 0, width: '200px' },
	        	{ targets: 1, width: '200px' },
	        	{ targets: 2, width: '200px' },
	        	{ targets: 3, width: '200px' },
	        	{ targets: 4, width: '200px' },
	        	{ targets: 5, width: '200px' },
	        	{ targets: 6, width: '200px' },
	        	{ targets: 7, width: '200px' },
	        ]
	    });
	}

	$(document).on('keyup','.search',function() {
			var table = $('#payable').dataTable();
			var search = $(".search").val();
			table.fnDestroy();
			payableList(search, status);	
			// $('#category_id').val(cat).trigger('change.select2');
			// $('#mat_category').val(mat_cat).trigger('change.select2');
	});

	$(document).on('click', '.add-payable', function(){
		$('.payable-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});


	$(document).on('click', '.edit-payable', function(){
		$('.payable-modal').find('.modal-title').text('Update payable');
		$('.payable-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.payable_id').val($(this).data('payable_id'));
		$('.account_id').val($(this).data('account_id'));
		$('.amount').val($(this).data('amount'));
		$('.payable_desc').val($(this).data('payable_desc'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.payable-modal');
		var type = $(this).attr('data-type');
		var payable_id = $('.payable_id').val();
		var account_id = $('.account_id').val();
		var amount = $('.amount').val();
		var payable_desc = $('.payable_desc').val();

		if (parseFloat(amount) == 0) {
			Swal.fire(notify_title, 'Payable amount should be greater than zeor', 'success');
			return false;
		}
		if (validate) {

			if (type == 'add') {
				var mydata = {type: type, account_id: account_id, amount: amount, payable_desc: payable_desc };
				var notify_title = 'Payable Added';
				var notify_text = 'Payable Added successfully!';
			} else {
				var mydata = {payable_id: payable_id, type: type, account_id: account_id, amount: amount, payable_desc: payable_desc };
				var notify_title = 'Payable Updated';
				var notify_text = 'Payable Updated successfully!';
			}

			$.ajax({
				url: base + "/payable/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".payable-modal").modal('hide');	
					    Swal.fire(notify_title, notify_text, 'success');
					    
					    var table = $('#payable').dataTable();
					    var search = $(".search").val();
					    table.fnDestroy();
					    payableList(search, status);	

					} else {
						Swal.fire('', data.msg, 'error');
					}
				}
			});		
		}

	});

	$(document).on('click', '#is_active', function(){
		var account_id = $(this).data('account_id');
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {account_id: account_id, is_active: is_active};
		$.ajax({
			url: base + "/accounts/statusUpdate",
			type: "POST",
			data: mydata,        
			success: function(data) {
			    if (data.success) {
				    Swal.fire('', data.msg, 'success');
				}
			}
		});	
	});

	$('.payable-modal').on('hidden.bs.modal', function (e) {
		$('.payable-modal').find('.modal-title').text('Add payable');
		$('.payable-modal').find('input').val('');
		$('.payable-modal').find('select').val('');
		$('.payable-modal').find('textarea').val('');
	});

	$(document).on('click', '.delete', function(){

		var payable_id = $(this).data('payable_id');


		Swal.fire({
		  title: 'Are you sure you want to delete this transaction',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, do it!'
		}).then((result) => {
		    if (result.isConfirmed) {

		        $.ajax({
		            url: base + "/payable/delete",
		            type: "POST",
		            data: {
		                payable_id: payable_id,
		            },        
		            success: function(data) {
		                if (data.success) {
		                	Swal.fire('', 'Transaction deleted successfully!', 'success');
		                    var table = $('#payable').dataTable();
		                    var search = $(".search").val();
		                    table.fnDestroy();
		                    payableList(search, status);

		                } else {
		                    Swal.fire('', 'Something went wrong! Please try later', 'error');
		                }
		            }
		        }); 

		    }
		})
	})

});