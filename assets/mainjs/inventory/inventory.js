$(document).ready(function(){
	invntoryList();

	function invntoryList(search =''){
		var table = $('#inventory').DataTable({
			"rowCallback": function( row, data ) {
				$('td:eq(0)', row).addClass('align-middle');
				$('td:eq(1)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(3)', row).addClass('align-middle');
				$('td:eq(4)', row).addClass('align-middle');
				$('td:eq(5)', row).addClass('align-middle');
				$('td:eq(6)', row).addClass('align-middle');
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
		     	"url": base +"/inventory/invntoryList",
		     	"dataType": "json",
		        "data":{ search: search },
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "product" },
		        { "data": "variation" },
		        { "data": "product_code" },
		        { "data": "category_title" },
		        { "data": "sale_qty" },
		        { "data": "sale_unit_price" },
		        { "data": "Action" },
		    ],
	    	"columnDefs": [
	        	{ targets: 0, width: '400px' },
	        	{ targets: 1, width: '200px' },
	        	{ targets: 2, width: '200px' },
	        	{ targets: 3, width: '200px' },
	        	{ targets: 4, width: '200px' },
	        	{ targets: 5, width: '200px' },
	        	{ targets: 6, width: '400px' },
	        ]
	    });
	}

	$(document).on('keyup','.search',function() {
			var table = $('#inventory').dataTable();
			var search = $(".search").val();
			table.fnDestroy();
			invntoryList(search);	
			// $('#category_id').val(cat).trigger('change.select2');
			// $('#mat_category').val(mat_cat).trigger('change.select2');
	});

	$(document).on('click','.generate_barcode',function() {
		var inv_in_id = $(this).attr('data-inv_in_id');
		var product_id = $(this).attr('data-product_id');

		var table = $('#inventory').dataTable();
		var search = $(".search").val();

		$.ajax({
			url: base + "/Inventory/generate_product_barcode",
			type: "POST",
			data: {inv_in_id: inv_in_id, product_id: product_id},        
			success: function(data) {
			    if (data.success) {
			    	table.fnDestroy();
			    	invntoryList(search);	
			    	Swal.fire('', 'Barcode Generated Successfully', 'success');
				} else {
					Swal.fire('', 'Something went wrong! Please try later', 'error');
				}
			}
		});	
	});

	$(document).on('click','.print-barcode',function() {
		var inv_in_id = $(this).data('inv_in_id');
		

		$.ajax({
			url: base + "/Inventory/getBarcodeData",
			type: "POST",
			data: {inv_in_id: inv_in_id},        
			success: function(data) {
			    if (data.success) {
			    	$('.barcode-modal').modal('show');
			    	$('.barcode-modal .modal-body').html(data.html);
				} else {
					Swal.fire('', 'Something went wrong! Please try later', 'error');
				}
			}
		});	

	});

	$(document).on('click','.Proceed',function() {
		var barcode = $(this).closest('tr').find('.print_barcode').val();
		var qty = parseInt($(this).closest('tr').find('.barcode_qty').val());

		if (qty == 0) {
			$(this).closest('tr').find('.barcode_qty').addClass('is-invalid');
			Swal.fire('', 'Quantity should be greater than zero!', 'error');
			return false;
		} else if (qty > 100) {
			$(this).closest('tr').find('.barcode_qty').addClass('is-invalid');
			Swal.fire('', 'Quantity should be less than 100!', 'error');
			return false;
		}

		if (qty > 0 && qty <= 100) {
			var url = base + "/inventory/product_barcode/"+barcode+"/"+qty;
			var win = window.open(url, '_blank');
			win.focus();
		}

	});

	$('.barcode-modal').on('hidden.bs.modal', function (e) {
	    $('.barcode_qty').val(1);
	});
});