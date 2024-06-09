$(document).ready(function(){
	productList();

	function productList(search =''){
		var table = $('#product').DataTable({
			"rowCallback": function( row, data ) {
				$('td:eq(0)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(3)', row).addClass('align-middle');
				$('td:eq(4)', row).addClass('align-middle');
				$('td:eq(5)', row).addClass('align-middle');
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
		     	"url": base +"/product/productList",
		     	"dataType": "json",
		        "data":{ search: search, is_active: '' },
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "check" },
		        { "data": "product" },
		        { "data": "product_code" },
		        { "data": "category_title" },
		        { "data": "status" },
		        { "data": "Action" },
		    ],
	    	"columnDefs": [
	        	{ targets: 0, width: '10px' },
	        	{ targets: 1, width: '400px' },
	        	{ targets: 2, width: '200px' },
	        	{ targets: 3, width: '200px' },
	        	{ targets: 4, width: '200px' },
	        	{ targets: 5, width: '200px' },
	        ]
	    });
	}

	activeProductList();
	function activeProductList(search =''){
		var table = $('#active_product').DataTable({
			"rowCallback": function( row, data ) {
				$('td:eq(0)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(3)', row).addClass('align-middle');
				$('td:eq(4)', row).addClass('align-middle');
				$('td:eq(5)', row).addClass('align-middle');
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
		     	"url": base +"/product/productList",
		     	"dataType": "json",
		        "data":{ search: search, is_active: 1 },
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "check" },
		        { "data": "product" },
		        { "data": "product_code" },
		        { "data": "category_title" },
		        // { "data": "status" },
		        { "data": "Action" },
		    ],
	    	"columnDefs": [
	        	{ targets: 0, width: '10px' },
	        	{ targets: 1, width: '400px' },
	        	{ targets: 2, width: '200px' },
	        	{ targets: 3, width: '200px' },
	        	{ targets: 4, width: '200px' },
	        	// { targets: 5, width: '200px' },
	        ]
	    });
	}

	deactiveProductList();
	function deactiveProductList(search =''){
		var table = $('#deactive_product').DataTable({
			"rowCallback": function( row, data ) {
				$('td:eq(0)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(3)', row).addClass('align-middle');
				$('td:eq(4)', row).addClass('align-middle');
				$('td:eq(5)', row).addClass('align-middle');
			},
			responsive: false,
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
		     	"url": base +"/product/productList",
		     	"dataType": "json",
		        "data":{ search: search, is_active: 0 },
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "check" },
		        { "data": "product" },
		        { "data": "product_code" },
		        { "data": "category_title" },
		        // { "data": "status" },
		        { "data": "Action" },
		    ],
	    	"columnDefs": [
	        	{ targets: 0, width: '10px' },
	        	{ targets: 1, width: '400px' },
	        	{ targets: 2, width: '200px' },
	        	{ targets: 3, width: '200px' },
	        	{ targets: 4, width: '200px' },
	        	// { targets: 5, width: '200px' },
	        ]
	    });
	}

	$(document).on('keyup','.search',function(){
			var table = $('#product').dataTable();
			table.fnDestroy();
			// $('#product').find('tbody').empty();
			var search = $(".search").val();
			productList(search);	
			// $('#category_id').val(cat).trigger('change.select2');
			// $('#mat_category').val(mat_cat).trigger('change.select2');
	});

	$(document).on('keyup','.active_search',function(){
			var table = $('#active_product').dataTable();
			table.fnDestroy();
			var search = $(".active_search").val();
			activeProductList(search);	
	});

	$(document).on('keyup','.deactive_search',function(){
			var table = $('#deactive_product').dataTable();
			table.fnDestroy();
			var search = $(".deactive_search").val();
			deactiveProductList(search);	
	});


	$(document).on('click', '#is_active', function(){
		var product_id = $(this).data('product_id');
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {product_id: product_id, is_active: is_active};
		$.ajax({
			url: base + "/product/statusUpdate",
			type: "POST",
			data: mydata,        
			success: function(data) {
			    if (data.success) {
				    Swal.fire('', data.msg, 'success');
				}
			}
		});	
	});

	$('.conversion-modal').on('hidden.bs.modal', function (e) {
		$('.conversion-modal').find('input').val('');
		$('.conversion-modal').find('.select').val('');
		$('.conversion-modal').find('.input').removeClass('is-invalid');
		$('.conversion-modal').find('.select').removeClass('is-invalid'); 
	});


	$(document).on('click', '.conversion', function(){
		var conversion = $(this).data('conversion');
		var product_id = $(this).data('product_id');
		var purch_unit = $(this).data('purch_unit');
		var inv_unit = $(this).data('inv_unit');
		var sale_unit = $(this).data('sale_unit');

		$('.product_id').val(product_id);
		$('.purch_unit').val(purch_unit);
		$('.inv_unit').val(inv_unit);
		$('.sale_unit').val(sale_unit);
		$('.type').val('add');

		if (purch_unit != inv_unit) {
			var selector = $('.big_unit');
			var html = `
						<option value="">Select</option>
						<option value="${purch_unit}">${purch_unit} (Purchase Unit)</option>
						<option value="${inv_unit}">${inv_unit} (Inventory Unit)</option>
						`;
			selector.html(html);
			$('.purch-inv-conversion').removeClass('d-none');
		}

		if (inv_unit != sale_unit) {
			var selector = $('.big_unit_2');
			var html = `
						<option value="">Select</option>
						<option value="${inv_unit}">${inv_unit} (Inventory Unit)</option>
						<option value="${sale_unit}">${sale_unit} (Sale Unit)</option>
						`;
			selector.html(html);
			$('.inv-sale-conversion').removeClass('d-none');
		}


		$('.conversion-modal').find('.modal-title').text('Add Conversion');
		$('.conversion-modal').find('.save').attr('data-type', 'add');
		$('.conversion-modal').find('.save').text('Add');

		if (conversion) {
			var purch_inv_conv = $(this).data('purch_inv_conv');
			if (purch_inv_conv) {
				$('.big_unit').val(purch_inv_conv.big_unit);
				$('.small_unit_qty').val(purch_inv_conv.small_unit_qty);
				$('.small_unit').val(purch_inv_conv.small_unit);
			}
			var inv_sale_conv = $(this).data('inv_sale_conv');
			if (inv_sale_conv) {
				console.log(inv_sale_conv.big_unit);

				$('.big_unit_2').val(inv_sale_conv.big_unit);
				$('.small_unit_qty_2').val(inv_sale_conv.small_unit_qty);
				$('.small_unit_2').val(inv_sale_conv.small_unit);
			}

			$('.conversion-modal').find('.modal-title').text('Update Conversion');
			$('.conversion-modal').find('.save').attr('data-type', 'update');
			$('.conversion-modal').find('.save').text('Update');
			$('.type').val('update');
		}
		$('.conversion-modal').modal('show');
	});

	//Purchase to Inventory Conversion
	$(document).on('change', '.big_unit', function() {
		var big_unit = $(this).val();

		if (big_unit != '') {
			var purch_unit = $('.purch_unit').val();
			var inv_unit = $('.inv_unit').val();

			if (big_unit == purch_unit) {
				$('.small_unit').val(inv_unit);
			} else {
				$('.small_unit').val(purch_unit);
			}

		} else {
			$('.small_unit').val('');
		}
	});

	//Inventory To Sale Conversion
	$(document).on('change', '.big_unit_2', function() {
		var big_unit_2 = $(this).val();

		if (big_unit_2 != '') {
			var inv_unit = $('.inv_unit').val();
			var sale_unit = $('.sale_unit').val();

			if (big_unit_2 == sale_unit) {
				$('.small_unit_2').val(inv_unit);
			} else {
				$('.small_unit_2').val(sale_unit);
			}

		} else {
			$('.small_unit_2').val('');
		}
	});

	$(document).on('click', '.save', function(){	
		var validate = checkValidation('.conversion-modal');
		if (!validate) {
			return false;
		} else {
			$('form').submit()
		}
	});

});