$(document).ready(function(){
	
	var table = $('#group').DataTable({
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
	     	"url": base +"/group/groupList",
	     	"dataType": "json",
	     	"type": "POST",
	    },
    	"columns": [
	        { "data": "sr" },
	        { "data": "group_name" },
	        { "data": "group_desc" },
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

	$(document).on('click', '.add-group', function(){
		$('.group-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-group', function(){
		$('.group-modal').find('.modal-title').text('Update group');
		$('.group-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').data('type', 'update');
		$('.save').text('Update');

		$('.group_id').val($(this).data('group_id'));
		$('.group_name').val($(this).data('group_name'));
		$('.group_desc').val($(this).data('group_desc'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.group-modal');
		if (validate) {
			var type = $(this).data('type');
			var group_id = $('.group_id').val();
			var group_name = $('.group_name').val();
			var group_desc = $('.group_desc').val();

			if (type == 'add') {
				var mydata = {type: type, group_name: group_name, group_desc: group_desc };
				var notify_title = 'Group Add';
				var notify_text = 'Group Add successfully!';
			} else {
				var mydata = {group_id: group_id, type: type, group_name: group_name, group_desc: group_desc };
				var notify_title = 'Group Update';
				var notify_text = 'Group Update successfully!';
			}

			$.ajax({
				url: base + "/group/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".group-modal").modal('hide');	
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

	$('.group-modal').on('hidden.bs.modal', function (e) {
		$('.group-modal').find('.modal-title').text('Add group');
	    $('.group_id').val('');
	    $('.group_name').val('');
	    $('.group_desc').val('');
	});

	$(document).on('click', '#is_active', function(){
		var group_id = $(this).data('group_id');
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {group_id: group_id, is_active: is_active};
		$.ajax({
			url: base + "/group/statusUpdate",
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