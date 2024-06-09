$(document).ready(function(){
	// storeList();
	
	var table = $('#store').DataTable({
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
	     	"url": base +"/store/storeList",
	     	"dataType": "json",
	     	"type": "POST",
	    },
    	"columns": [
	        { "data": "sr" },
	        { "data": "store_name" },
	        { "data": "store_code" },
	        { "data": "store_phone" },
	        { "data": "is_active" },
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

	$(document).on('click', '.add-store', function(){
		$('.store-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-store', function(){
		$('.store-modal').find('.modal-title').text('Update Store');
		$('.store-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.store_id').val($(this).data('store_id'));
		$('.store_name').val($(this).data('store_name'));
		$('.store_code').val($(this).data('store_code'));
		$('.store_phone').val($(this).data('store_phone'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.store-modal');
		if (validate) {
			var type = $(this).data('type');
			var store_id = $('.store_id').val();
			var store_name = $('.store_name').val();
			var store_code = $('.store_code').val();
			var store_phone = $('.store_phone').val();

			if (type == 'add') {
				var mydata = {type: type, store_name: store_name, store_code: store_code, store_phone: store_phone};
				var notify_title = 'Store Add';
				var notify_text = 'Store Added successfully!';
			} else {
				var mydata = { store_id: store_id, type: type, store_name: store_name, store_code: store_code, store_phone: store_phone};
				var notify_title = 'Store Update';
				var notify_text = 'Store Updated successfully!';
			}

			$.ajax({
				url: base + "/store/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".store-modal").modal('hide');	
					    Swal.fire(notify_title, notify_text, 'success');
					    table.ajax.reload();
					} else {
						Swal.fire('', data.msg, 'error');
						$('.code').addClass('is-invalid');
					}
				}
			});		
		}

	});

	$('.store-modal').on('hidden.bs.modal', function (e) {
		$('.store-modal').find('.modal-title').text('Add store');
	    $('.store_id').val('');
	    $('.store_name').val('');
	    $('.store_code').val('');
	    $('.store_phone').val('');
	});

	$(document).on('click', '#is_active', function(){
		var store_id = $(this).data('store_id');
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {store_id: store_id, is_active: is_active};
		$.ajax({
			url: base + "/store/statusUpdate",
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