$(document).ready(function(){
	// variantList();
	
	var table = $('#variant').DataTable({
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
	     	"url": base +"/variant/variantList",
	     	"dataType": "json",
	     	"type": "POST",
	    },
    	"columns": [
	        { "data": "sr" },
	        { "data": "variant_name" },
	        { "data": "variant_desc" },
	        { "data": "status" },
	        { "data": "Action" },
	    ],
    	"columnDefs": [
        	{ targets: 0, width: '150px' },
        	{ targets: 1, width: '200px' },
        	{ targets: 0, width: '200px' },
        	{ targets: 3, width: '200px' },
        ]
    });

	$(document).on('click', '.add-variant', function(){
		$('.variant-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-variant', function(){
		$('.variant-modal').find('.modal-title').text('Update variant');
		$('.variant-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.variant_id').val($(this).data('variant_id'));
		$('.variant_name').val($(this).data('variant_name'));
		$('.variant_desc').val($(this).data('variant_desc'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.variant-modal');
		if (validate) {
			var type = $(this).data('type');
			var variant_id = $('.variant_id').val();
			var variant_name = $('.variant_name').val();
			var variant_desc = $('.variant_desc').val();

			if (type == 'add') {
				var mydata = {type: type, variant_name: variant_name, variant_desc: variant_desc };
				var notify_title = 'Variant Add';
				var notify_text = 'Variant Add successfully!';
			} else {
				var mydata = {variant_id: variant_id, type: type, variant_name: variant_name, variant_desc: variant_desc };
				var notify_title = 'Variant Update';
				var notify_text = 'Variant Update successfully!';
			}

			$.ajax({
				url: base + "/variant/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".variant-modal").modal('hide');	
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

	$('.variant-modal').on('hidden.bs.modal', function (e) {
		$('.variant-modal').find('.modal-title').text('Add variant');
	    $('.variant_id').val('');
	    $('.variant_name').val('');
	    $('.variant_desc').val('');
	});

	$(document).on('click', '#is_active', function(){
		var variant_id = $(this).data('variant_id');
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {variant_id: variant_id, is_active: is_active};
		$.ajax({
			url: base + "/variant/statusUpdate",
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