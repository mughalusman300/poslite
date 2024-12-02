$(document).on('click','.print-barcode',function() {
	var item_id = $(this).data('item_id');
	var barcode = $(this).data('barcode');
	var inventory_qty = $(this).data('inventory_qty');

	

	$.ajax({
		url: base + "/Inventory/getBarcodeData",
		type: "POST",
		data: {item_id: item_id, barcode: barcode, inventory_qty: inventory_qty},        
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

$(document).on('click','.print',function() {
	var barcode = $(this).closest('tr').find('.barcode').val();
	var qty = parseInt($(this).closest('tr').find('.barcode_qty').val());

	if (qty == 0) {
		$(this).closest('tr').find('.barcode_qty').addClass('is-invalid');
		Swal.fire('', 'Quantity should be greater than zero!', 'error');
		return false;
	} 
	// else if (qty > 100) {
	// 	$(this).closest('tr').find('.barcode_qty').addClass('is-invalid');
	// 	Swal.fire('', 'Quantity should be less than 100!', 'error');
	// 	return false;
	// }

	if (qty > 0) {
		var url = base + "/inventory/item_barcode/"+barcode+"/"+qty;
		var win = window.open(url, '_blank');
		win.focus();
	}

});

$(document).on('click',".delete",function (e) {
	var selector = $(this);
	var inventory_detail_id = selector.attr('data-inventory_detail_id');

	Swal.fire({
	  title: 'Are you sure?',
	  text: "You won't be able to revert this!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	  	if (result.isConfirmed) {
	  		$.ajax({
	  			url: base + "/Inventory/delete_detail_row",
	  			type: "POST",
	  			data: {inventory_detail_id: inventory_detail_id},        
	  			success: function(data) {
	  			    if (data.success) {
	  			    	selector.parents('.parent-row').remove();
   						Swal.fire('', 'Deleted Successfully', 'success');
	  				} else {
	  					Swal.fire('', 'Something went wrong! Please try later', 'error');
	  				}
	  			}
	  		});	

	  	}
	})

});