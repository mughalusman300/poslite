$(document).ready(function(){
	expense_header_list();
	var table;
	function expense_header_list(){
		table = $('#expense_header').DataTable({
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
		     	"url": base +"/expense/expense_header_list",
		     	"dataType": "json",
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "sr" },
		        { "data": "name" },
		        { "data": "header_desc" },
		        { "data": "status" },
		        { "data": "Action" },
		    ],
	    	"columnDefs": [
	        	{ targets: 0, width: '150px' },
	        	{ targets: 1, width: '200px' },
	        	{ targets: 0, width: '200px' },
	        	{ targets: 3, width: '200px' },
	        	{ targets: 4, width: '200px' },
	        ]
	    });
	}

	$(document).on('click', '.add-header', function(){
		$('.expense-header-modal').modal('show');
		$('.save').attr('data-type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-header', function(){
		$('.expense-header-modal').find('.modal-title').text('Update Header');
		$('.expense-header-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.id').val($(this).data('id'));
		$('.name').val($(this).data('name'));
		$('.header_desc').val($(this).data('header_desc'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.expense-header-modal');
		if (validate) {
			var type = $(this).attr('data-type');
			var id = $('.id').val();
			var name = $('.name').val();
			var header_desc = $('.header_desc').val();

			if (type == 'add') {
				var mydata = {type: type, name: name, header_desc: header_desc };
				var notify_title = 'Header Add';
				var notify_text = 'Header Add successfully!';
			} else {
				var mydata = {type: type, id: id,  name: name, header_desc: header_desc };
				var notify_title = 'Header Update';
				var notify_text = 'Header Update successfully!';
			}

			$.ajax({
				url: base + "/expense/add_header",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".expense-header-modal").modal('hide');	
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

	$('.expense-header-modal').on('hidden.bs.modal', function (e) {
		$('.expense-header-modal').find('.modal-title').text('Add Header');
	    $('.expense-header-modal').find('input').val('');
	    $('.expense-header-modal').find('input').removeClass('is-invalid');
	    $('.expense-header-modal').find('select').val('');
	    $('.expense-header-modal').find('select').removeClass('is-invalid');
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
			url: base + "/expense/expense_header_status_update",
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