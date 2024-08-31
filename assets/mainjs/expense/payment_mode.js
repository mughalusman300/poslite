$(document).ready(function(){
	payment_mode_list();
	var table;
	function payment_mode_list(){
		table = $('#payment_mode').DataTable({
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
		     	"url": base +"/expense/payment_mode_list",
		     	"dataType": "json",
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "sr" },
		        { "data": "name" },
		        { "data": "payment_type" },
		        { "data": "payment_mode_desc" },
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
	        ]
	    });
	}

	$(document).on('click', '.add-mode', function(){
		$('.payment-mode-modal').modal('show');
		$('.save').attr('data-type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-mode', function(){
		$('.payment-mode-modal').find('.modal-title').text('Update Payment Mode');
		$('.payment-mode-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		console.log($(this).data('payment_type'))

		$('.id').val($(this).data('id'));
		$('.payment_type').val($(this).data('payment_type'));
		$('.name').val($(this).data('name'));
		$('.payment_mode_desc').val($(this).data('payment_mode_desc'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.payment-mode-modal');
		if (validate) {
			var type = $(this).attr('data-type');
			var id = $('.id').val();
			var payment_type = $('.payment_type').val();
			console.log(payment_type)
			var name = $('.name').val();
			var payment_mode_desc = $('.payment_mode_desc').val();

			if (type == 'add') {
				var mydata = {type: type, payment_type: payment_type, name: name, payment_mode_desc: payment_mode_desc };
				var notify_title = 'Payment Mode Add';
				var notify_text = 'Payment Mode Add successfully!';
			} else {
				var mydata = {type: type, payment_type: payment_type, id: id,  name: name, payment_mode_desc: payment_mode_desc };
				var notify_title = 'Payment Mode Update';
				var notify_text = 'Payment Mode Update successfully!';
			}

			$.ajax({
				url: base + "/expense/add_mode",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".payment-mode-modal").modal('hide');	
					    Swal.fire(notify_title, notify_text, 'success');
					    table.ajax.reload();
					} else {
						Swal.fire('', data.msg, 'error');
						$('.name').addClass('is-invalid');
					}
				}
			});		
		}

	});

	$('.payment-mode-modal').on('hidden.bs.modal', function (e) {
		$('.payment-mode-modal').find('.modal-title').text('Add Modal');
	    $('.payment-mode-modal').find('input').val('');
	    $('.payment-mode-modal').find('input').removeClass('is-invalid');
	    $('.payment-mode-modal').find('select').val('');
	    $('.payment-mode-modal').find('select').removeClass('is-invalid');
	});

	$(document).on('click', '#is_active', function(){
		var id = $(this).attr('data-id');
		console.log(id);
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {id: id, is_active: is_active};
		$.ajax({
			url: base + "/expense/mode_status_update",
			type: "POST",
			data: mydata,        
			success: function(data) {
			    if (data.success) {
				    Swal.fire('', data.msg, 'success');
				}
			}
		});	
	});

});