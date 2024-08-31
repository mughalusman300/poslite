$(document).ready(function(){
	party_list();
	var table;
	function party_list(){
		table = $('#party').DataTable({
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
		     	"url": base +"/expense/party_list",
		     	"dataType": "json",
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "sr" },
		        { "data": "name" },
		        { "data": "party_type" },
		        { "data": "contact" },
		        { "data": "detail" },
		        { "data": "note" },
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
	        	{ targets: 6, width: '200px' },
	        	{ targets: 7, width: '200px' },
	        ]
	    });
	}

	$(document).on('click', '.add-party', function(){
		$('.party-modal').modal('show');
		$('.save').attr('data-type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-party', function(){
		$('.party-modal').find('.modal-title').text('Update Party');
		$('.party-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.id').val($(this).data('id'));
		$('.name').val($(this).data('name'));
		$('.contact').val($(this).data('contact'));
		$('.party_type').val($(this).data('party_type'));
		$('.note').val($(this).data('note'));
		$('.detail').val($(this).data('detail'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.party-modal');
		if (validate) {
			var type = $(this).attr('data-type');
			var id = $('.id').val();
			var name = $('.name').val();
			var contact = $('.contact').val();
			var party_type = $('.party_type').val();
			var note = $('.note').val();
			var detail = $('.detail').val();

			if (type == 'add') {
				var mydata = {type: type, name: name, contact: contact, party_type: party_type, note: note, detail: detail};
				var notify_title = 'Party Add';
				var notify_text = 'Party Add successfully!';
			} else {
				var mydata = {type: type, id: id, name: name, contact: contact, party_type: party_type, note: note, detail: detail };
				var notify_title = 'Party Update';
				var notify_text = 'Party Update successfully!';
			}

			$.ajax({
				url: base + "/expense/add_party",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".party-modal").modal('hide');	
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

	$('.party-modal').on('hidden.bs.modal', function (e) {
		$('.party-modal').find('.modal-title').text('Add party');
	    $('.party-modal').find('input').val('');
	    $('.party-modal').find('input').removeClass('is-invalid');
	    $('.party-modal').find('select').val('');
	    $('.party-modal').find('select').removeClass('is-invalid');
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
			url: base + "/expense/party_status_update",
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