$(document).ready(function(){
	// locationList();
	
	var table = $('#location').DataTable({
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
	     	"url": base +"/location/locationList",
	     	"dataType": "json",
	     	"type": "POST",
	    },
    	"columns": [
	        { "data": "sr" },
	        { "data": "location_name" },
	        { "data": "location_city" },
	        { "data": "location_country" },
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

	$(document).on('click', '.add-location', function(){
		$('.location-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-location', function(){
		$('.location-modal').find('.modal-title').text('Update location');
		$('.location-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.location_id').val($(this).data('location_id'));
		$('.location_name').val($(this).data('location_name'));
		$('.location_city').val($(this).data('location_city'));
		$('.location_country').val($(this).data('location_country'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.location-modal');
		if (validate) {
			var type = $(this).data('type');
			var location_id = $('.location_id').val();
			var location_name = $('.location_name').val();
			var location_city = $('.location_city').val();
			var location_country = $('.location_country').val();

			if (type == 'add') {
				var mydata = {type: type, location_name: location_name, location_city: location_city, location_country: location_country};
				var notify_title = 'Location Add';
				var notify_text = 'Location Added successfully!';
			} else {
				var mydata = { location_id: location_id, type: type, location_name: location_name, location_city: location_city, location_country: location_country};
				var notify_title = 'Location Update';
				var notify_text = 'Location Updated successfully!';
			}

			$.ajax({
				url: base + "/location/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".location-modal").modal('hide');	
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

	$('.location-modal').on('hidden.bs.modal', function (e) {
		$('.location-modal').find('.modal-title').text('Add location');
	    $('.location_id').val('');
	    $('.location_name').val('');
	    $('.location_city').val('');
	    $('.location_country').val('');
	});

	$(document).on('click', '#is_active', function(){
		var location_id = $(this).data('location_id');
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {location_id: location_id, is_active: is_active};
		$.ajax({
			url: base + "/location/statusUpdate",
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