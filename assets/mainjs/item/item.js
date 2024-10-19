$(document).ready(function(){
	itemList();
	
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
	     	"url": base +"/item/itemList",
	     	"dataType": "json",
	     	"type": "POST",
	    },
    	"columns": [
	        { "data": "sr" },
	        { "data": "itemName" },
	        { "data": "itemCategory" },
	        { "data": "qty" },
	        { "data": "purchasePrice" },
	        { "data": "salePrice" },
	        { "data": "discount" },
	        { "data": "status" },
	        { "data": "Action" },
	    ],
    	"columnDefs": [
        	{ targets: 0, width: '150px' },
        	{ targets: 1, width: '200px' },
        	{ targets: 0, width: '200px' },
        	{ targets: 3, width: '150px' },
        	{ targets: 4, width: '200px' },
        	{ targets: 5, width: '200px' },
        	{ targets: 6, width: '200px' },
        	{ targets: 7, width: '200px' },
        	{ targets: 8, width: '200px' },
        ]
    });
	function itemList(){
	}

	$(document).on('click', '.add-item', function(){
		$('.item-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-item', function(){
		$('.item-modal').find('.modal-title').text('Update Item');
		$('.item-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.itemsId').val($(this).data('itemsid'));
		$('.itemName').val($(this).data('itemname'));
		$('.itemCategory').val($(this).data('itemcategory'));
		$('.purchasePrice').val($(this).data('purchaseprice'));
		$('.salePrice').val($(this).data('saleprice'));
		$('.discount').val($(this).data('discount'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.item-modal');
		if (validate) {
			var type = $(this).attr('data-type');
			var itemsId = $('.itemsId').val();
			var itemName = $('.itemName').val();
			var itemCategory = $('.itemCategory').val();
			var purchasePrice = $('.purchasePrice').val();
			var salePrice = $('.salePrice').val();
			var discount = $('.discount').val();

			if (type == 'add') {
				var mydata = {type: type, itemName: itemName, itemCategory: itemCategory, purchasePrice: purchasePrice, salePrice: salePrice, discount: discount };
				var notify_title = 'Item Add';
				var notify_text = 'Item Add successfully!';
			} else {
				var mydata = {type: type, itemsId: itemsId,  itemName: itemName, itemCategory: itemCategory, purchasePrice: purchasePrice, salePrice: salePrice, discount: discount };
				var notify_title = 'Item Update';
				var notify_text = 'Item Update successfully!';
			}

			$.ajax({
				url: base + "/item/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".item-modal").modal('hide');	
					    Swal.fire(notify_title, notify_text, 'success');
					    table.ajax.reload();
					} else {
						Swal.fire('', data.msg, 'error');
						$('.itemName').addClass('is-invalid');
					}
				}
			});		
		}

	});

	$(document).on('keyup', '.salePrice', function(){
		var salePrice = $(this).val();
		var purchasePrice = $('.purchasePrice').val();
		if (purchasePrice == '') {
			$(this).val('');
			$(this).focus();
			$(this).addClass('is-invalid');
			Swal.fire('', 'Please Add Purchase Price First!', 'error');
		}
	});
	$(document).on('blur', '.salePrice', function(){
		var salePrice = $(this).val();
		var purchasePrice = $('.purchasePrice').val();

		if (salePrice != '') {
			purchasePrice = parseFloat(purchasePrice).toFixed(2);
			salePrice = parseFloat(salePrice).toFixed(2);
			if (Number(purchasePrice) >= Number(salePrice)) {
				Swal.fire('', 'Sales Price can not be less than or equal to purchase price!', 'error');
				$(this).val('');
				$(this).focus();
				$(this).addClass('is-invalid');
			}
		}
	});

	$(document).on('blur', '.purchasePrice', function(){
		var salePrice = $('.salePrice').val();
		var purchasePrice = $('.purchasePrice').val();

		if (purchasePrice != '' && salePrice != '') {
			purchasePrice = parseFloat(purchasePrice).toFixed(2);
			salePrice = parseFloat(salePrice).toFixed(2);
			if (Number(purchasePrice) == Number(salePrice) || Number(purchasePrice) > Number(salePrice)) {
				Swal.fire('', 'Purchase Price can not be greater than or equal to sale price!', 'error');
				$(this).val('');
				$(this).focus();
				$(this).addClass('is-invalid');
			}
		}
	});

	$(document).on('blur', '.discount', function(){
		var discount = $(this).val();
		if (discount != '') {
			discount = parseFloat(discount).toFixed(2);

			if (discount > 100) {
				Swal.fire('', 'Discount Price can not be greater than 100 percent', 'error');
				$(this).val('');
				$(this).focus();
				$(this).addClass('is-invalid');
			}
		}
	});	
	$('.item-modal').on('hidden.bs.modal', function (e) {
		$('.item-modal').find('.modal-title').text('Add Item');
	    $('.item-modal').find('input').val('');
	    $('.item-modal').find('input').removeClass('is-invalid');
	    $('.item-modal').find('select').val('');
	    $('.item-modal').find('select').removeClass('is-invalid');
	});

	$(document).on('click', '#itemActive', function(){
		var itemsId = $(this).attr('data-itemsid');
		console.log(itemsId);
		if ($(this).is(":checked")) {
			var itemActive = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var itemActive = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {itemsId: itemsId, itemActive: itemActive};
		$.ajax({
			url: base + "/item/statusUpdate",
			type: "POST",
			data: mydata,        
			success: function(data) {
			    if (data.success) {
				    Swal.fire('', data.msg, 'success');
				}
			}
		});	
	});

	$(document).on('click','.print-barcode',function() {
		var item_id = $(this).data('item_id');
		var barcode = $(this).data('barcode');

		$.ajax({
			url: base + "/item/getItemBarcodeData",
			type: "POST",
			data: {item_id: item_id, barcode: barcode},        
			success: function(data) {
			    if (data.success) {
			    	$('.item-barcode-modal').modal('show');
			    	$('.item-barcode-modal .modal-body').html(data.html);
				} else {
					Swal.fire('', 'Something went wrong! Please try later', 'error');
				}
			}
		});	

	});

	$(document).on('click','.print',function() {
		var barcode = $(this).closest('tr').find('.old_barcode').val();
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

	$(document).on('click','.update-barcode',function() {
		var new_barcode = $('.new_barcode').val();
		var old_barcode = $('.old_barcode').val();
		if (new_barcode == old_barcode) {
			return false;
		}
		var validate = checkValidation('#barcode-table');
		if (validate) {
			$.ajax({
				url: base + "/item/update_barcode",
				type: "POST",
				data: {old_barcode: old_barcode, new_barcode: new_barcode},        
				success: function(data) {
				    if (data.success) {
				    	$('.old_barcode').val(new_barcode);
				    	let url = $('.barcode-img').attr('src');
				    	let trimmedUrl = url.substring(0, url.lastIndexOf('/'));
				    	new_image_url = trimmedUrl+'/'+new_barcode+'.png';
				    	console.log(new_image_url)
				    	$('.barcode-img').attr('src', new_image_url);
				    	Swal.fire('', 'Barcode updated successfully!', 'success');
					} else {
						Swal.fire('', data.msg, 'error');
					}
				}
			});	

		}

	});

});