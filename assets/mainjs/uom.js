$(document).ready(function(){
	
	var table = $('#uom').DataTable({
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
	     	"url": base +"/uom/uomList",
	     	"dataType": "json",
	     	"type": "POST",
	    },
    	"columns": [
	        { "data": "sr" },
	        { "data": "uom_name" },
	        { "data": "uom_code" },
	        { "data": "Action" },
	    ],
    	"columnDefs": [
        	{ targets: 0, width: '150px' },
        	{ targets: 1, width: '200px' },
        	{ targets: 2, width: '200px' },
        	{ targets: 3, width: '200px' },
        ]
    });

	$(document).on('click', '.add-uom', function(){
		$('.uom-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-uom', function(){
		$('.uom-modal').find('.modal-title').text('Update uom');
		$('.uom-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.uom_id').val($(this).data('uom_id'));
		$('.uom_name').val($(this).data('uom_name'));
		$('.uom_code').val($(this).data('uom_code'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.uom-modal');
		if (validate) {
			var type = $(this).data('type');
			var uom_id = $('.uom_id').val();
			var uom_name = $('.uom_name').val();
			var uom_code = $('.uom_code').val();

			if (type == 'add') {
				var mydata = {type: type, uom_name: uom_name, uom_code: uom_code };
				var notify_title = 'UOM Add';
				var notify_text = 'UOM Add successfully!';
			} else {
				var mydata = {uom_id: uom_id, type: type, uom_name: uom_name, uom_code: uom_code };
				var notify_title = 'UOM Update';
				var notify_text = 'UOM Update successfully!';
			}

			$.ajax({
				url: base + "/uom/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".uom-modal").modal('hide');	
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

	$(document).on('click', '.delete-uom', function(){
		var uom_id = $(this).data('uom_id');
		swal.fire({
			title: 'Are you sure?',
			text: "This will be deleted!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
	    }).then((result) => {
	        if (result.isConfirmed) { 
	        	$.ajax({
	        		url: base + "/uom/delete",
	        		type: "POST",
	        		data: { uom_id: uom_id },        
	        		success: function(data) {
	        		    if (data.success) {
	        			    Swal.fire('Deleted', 'UOM delted successfully!', 'success');
	        			    table.ajax.reload();
	        			}
	        		}
	        	});		      
	        }
	    });

	});
	$('.uom-modal').on('hidden.bs.modal', function (e) {
		$('.uom-modal').find('.modal-title').text('Add uom');
	    $('.uom_id').val('');
	    $('.uom_name').val('');
	    $('.uom_code').val('');
	});

});