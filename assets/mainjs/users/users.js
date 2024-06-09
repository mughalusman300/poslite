$(document).ready(function(){
	itemList();
	
	var table = $('#users').DataTable({
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
	     	"url": base +"/users/usersList",
	     	"dataType": "json",
	     	"type": "POST",
	    },
    	"columns": [
	        { "data": "sr" },
	        { "data": "name" },
	        { "data": "email" },
	        { "data": "power" },
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
	function itemList(){
	}

	$(document).on('click', '.add-user', function(){
		$('.users-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-user', function(){
		// debugger;
		console.log('test');
		$('.users-modal').find('.modal-title').text('Update user');
		$('.users-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.id').val($(this).data('id'));
		$('.name').val($(this).data('name'));
		$('.email').val($(this).data('email'));
		$('.power').val($(this).data('power'));
		// $('.password').val($(this).data('password'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.users-modal');
		if (validate) {
			var type = $(this).data('type');
			var id = $('.id').val();
			var name = $('.name').val();
			var email = $('.email').val();
			var power = $('.power').val();
			var password = $('.password').val();

			if (type == 'add') {
				var mydata = {type: type, name: name, email: email, power: power, password: password };
				var notify_title = 'User Add';
				var notify_text = 'User Add successfully!';
			} else {
				var mydata = {type: type, id: id,  name: name, email: email, power: power, password: password };
				var notify_title = 'User Updated';
				var notify_text = 'User Updated successfully!';
			}

			$.ajax({
				url: base + "/users/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".users-modal").modal('hide');	
					    Swal.fire(notify_title, notify_text, 'success');
					    table.ajax.reload();
					} else {
						Swal.fire('', data.msg, 'error');
						$('.email').addClass('is-invalid');
					}
				}
			});		
		}

	});

	$('.users-modal').on('hidden.bs.modal', function (e) {
		$('.users-modal').find('.modal-title').text('Add User');
	    $('.users-modal').find('input').val('');
	    $('.users-modal').find('input').removeClass('is-invalid');
	    $('.users-modal').find('select').val('');
	    $('.users-modal').find('select').removeClass('is-invalid');
	});

	$(document).on('click', '#is_enable', function(){
		var id = $(this).attr('data-id');
		console.log(id);
		if ($(this).is(":checked")) {
			var is_enable = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_enable = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {id: id, is_enable: is_enable};
		$.ajax({
			url: base + "/users/statusUpdate",
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