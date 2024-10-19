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