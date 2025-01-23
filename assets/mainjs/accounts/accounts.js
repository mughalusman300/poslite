$(document).ready(function(){
	accountList();

	function accountList(search =''){
		var table = $('#accounts').DataTable({
			"rowCallback": function( row, data ) {
				$('td:eq(0)', row).addClass('align-middle');
				$('td:eq(1)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(3)', row).addClass('align-middle');
				$('td:eq(4)', row).addClass('align-middle');
			},
			responsive: false,
			// buttons: [
			// 	{ extend: 'print', className: 'btn btn-default btn-sm' },
			// 	{ extend: 'csv', className: 'btn btn-default btn-sm' }
			// ],
			"searching": false,
	    	"serverSide": true,
			//"stateSave": true,
			"paging": true,
			"lengthChange": false,
	    	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	    	"order": [[ 0, "desc" ]],
			"pageLength": 25,	
			"ordering"   :false,
	        "processing": true,
	        "ajax":{
		     	"url": base +"/accounts/accountList",
		     	"dataType": "json",
		        "data":{ search: search },
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "account_name" },
		        { "data": "type" },
		        { "data": "party_name" },
		        { "data": "account_desc" },
		        { "data": "status" },
		        { "data": "created_at" },
		        { "data": "action" },
		    ],
	    	"columnDefs": [
	        	{ targets: 0, width: '200px' },
	        	{ targets: 1, width: '200px' },
	        	{ targets: 2, width: '200px' },
	        	{ targets: 3, width: '200px' },
	        	{ targets: 4, width: '200px' },
	        ]
	    });
	}

	$(document).on('keyup','.search',function() {
			var table = $('#accounts').dataTable();
			var search = $(".search").val();
			table.fnDestroy();
			accountList(search);	
			// $('#category_id').val(cat).trigger('change.select2');
			// $('#mat_category').val(mat_cat).trigger('change.select2');
	});

	$(document).on('click', '.add-account', function(){
		$('.accounts-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-account', function(){
		$('.accounts-modal').find('.modal-title').text('Update account');
		$('.accounts-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.account_id').val($(this).data('account_id'));
		$('.account_name').val($(this).data('account_name'));
		$('.party_id').val($(this).data('party_id'));
		$('.account_type').val($(this).data('type'));
		$('.account_desc').val($(this).data('account_desc'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.accounts-modal');
		if (validate) {
			var type = $(this).attr('data-type');
			var account_id = $('.account_id').val();
			var account_name = $('.account_name').val();
			var party_id = $('.party_id').val();
			var account_type = $('.account_type').val();
			var account_desc = $('.account_desc').val();

			if (type == 'add') {
				var mydata = {type: type, account_name: account_name, party_id: party_id, account_type: account_type, account_desc: account_desc };
				var notify_title = 'Account Add';
				var notify_text = 'Account Add successfully!';
			} else {
				var mydata = {account_id: account_id, type: type, account_name: account_name, party_id: party_id, account_type: account_type, account_desc: account_desc };
				var notify_title = 'Account Update';
				var notify_text = 'Account Update successfully!';
			}

			$.ajax({
				url: base + "/accounts/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".accounts-modal").modal('hide');	
					    Swal.fire(notify_title, notify_text, 'success');
					    
					    var table = $('#accounts').dataTable();
					    var search = $(".search").val();
					    table.fnDestroy();
					    accountList(search);	

					} else {
						Swal.fire('', data.msg, 'error');
						$('.account_name').addClass('is-invalid');
					}
				}
			});		
		}

	});

	$(document).on('click', '#is_active', function(){
		var account_id = $(this).data('account_id');
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {account_id: account_id, is_active: is_active};
		$.ajax({
			url: base + "/accounts/statusUpdate",
			type: "POST",
			data: mydata,        
			success: function(data) {
			    if (data.success) {
				    Swal.fire('', data.msg, 'success');
				}
			}
		});	
	});

	$('.accounts-modal').on('hidden.bs.modal', function (e) {
		$('.accounts-modal').find('.modal-title').text('Add account');
		$('.accounts-modal').find('input').val('');
		$('.accounts-modal').find('select').val('');
		$('.accounts-modal').find('textarea').val('');
	});

});