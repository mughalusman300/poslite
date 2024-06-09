$(document).ready(function(){
	categoryList();
	
	var table = $('#category').DataTable({
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
	     	"url": base +"/category/categoryList",
	     	"dataType": "json",
	     	"type": "POST",
	    },
    	"columns": [
	        { "data": "sr" },
	        { "data": "title" },
	        { "data": "code" },
	        { "data": "desc" },
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
	function categoryList(){
	}

	$(document).on('click', '.add-category', function(){
		$('.category-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-category', function(){
		$('.category-modal').find('.modal-title').text('Update Category');
		$('.category-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.category_id').val($(this).data('category_id'));
		$('.cat_title').val($(this).data('title'));
		$('.code').val($(this).data('code'));
		$('.desc').val($(this).data('desc'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.category-modal');
		if (validate) {
			var type = $(this).data('type');
			var category_id = $('.category_id').val();
			var title = $('.cat_title').val();
			var code = $('.code').val();
			var desc = $('.desc').val();

			if (type == 'add') {
				var mydata = {type: type, title: title, code: code, desc: desc };
				var notify_title = 'Category Add';
				var notify_text = 'Category Add successfully!';
			} else {
				var mydata = {category_id: category_id, type: type, title: title, code: code, desc: desc };
				var notify_title = 'Category Update';
				var notify_text = 'Category Update successfully!';
			}

			$.ajax({
				url: base + "/category/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".category-modal").modal('hide');	
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

	$('.category-modal').on('hidden.bs.modal', function (e) {
		$('.category-modal').find('.modal-title').text('Add Category');
	    $('.category_id').val('');
	    $('.cat_title').val('');
	    $('.code').val('');
	    $('.desc').val('');
	});

	$(document).on('click', '#is_active', function(){
		var category_id = $(this).data('category_id');
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {category_id: category_id, is_active: is_active};
		$.ajax({
			url: base + "/category/statusUpdate",
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