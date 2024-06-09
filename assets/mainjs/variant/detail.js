$(document).ready(function(){
	// variantList();
	var variant_id = $('#variant_id').val();
	var table = $('#detail').DataTable({
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
	     	"url": base +"/variant/detailList",
	     	"dataType": "json",
	     	"data":{variant_id:variant_id},
	     	"type": "POST",
	    },
    	"columns": [
	        { "data": "sr" },
	        { "data": "variant_detail_name" },
	        { "data": "variant_detail_desc" },
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

	$(document).on('click', '.add-variant-detail', function(){
		$('.variant-detail-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-variant-detail', function(){
		$('.variant-detail-modal').find('.modal-title').text('Update variant');
		$('.variant-detail-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.variant_detail_id').val($(this).data('variant_detail_id'));
		$('.variant_detail_name').val($(this).data('variant_detail_name'));
		$('.variant_detail_desc').val($(this).data('variant_detail_desc'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.variant-detail-modal');
		if (validate) {
			var type = $(this).data('type');
			var variant_detail_id = $('.variant_detail_id').val();
			var variant_detail_name = $('.variant_detail_name').val();
			var variant_detail_desc = $('.variant_detail_desc').val();

			if (type == 'add') {
				var mydata = {type: type, variant_id: variant_id, variant_detail_name: variant_detail_name, variant_detail_desc: variant_detail_desc };
				var notify_title = 'Variant Add';
				var notify_text = 'Variant Add successfully!';
			} else {
				var mydata = {variant_detail_id: variant_detail_id, variant_id: variant_id, type: type, variant_detail_name: variant_detail_name, variant_detail_desc: variant_detail_desc };
				var notify_title = 'Variant Update';
				var notify_text = 'Variant Update successfully!';
			}

			$.ajax({
				url: base + "/variant/add_detail",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".variant-detail-modal").modal('hide');	
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

	$('.variant-detail-modal').on('hidden.bs.modal', function (e) {
		$('.variant-detail-modal').find('.modal-title').text('Add variant');
	    $('.variant_detail_id').val('');
	    $('.variant_detail_name').val('');
	    $('.variant_detail_desc').val('');
	});

	$(document).on('click', '#is_active', function(){
		var variant_detail_id = $(this).data('variant_detail_id');
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {variant_detail_id: variant_detail_id, is_active: is_active};
		$.ajax({
			url: base + "/variant/statusUpdateDetail",
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