$(document).ready(function(){
	select2('.select2');

	function select2(selector){
		$( selector ).select2( {
		    theme: "bootstrap-5",
		    selectionCssClass: "select2--small",
		    dropdownCssClass: "select2--small",
		});
	}

	$(document).on('select2:open', () => {
		document.querySelector('.select2-search__field').focus();
	});	

	$(document).on('change', '.item_id', function() {
       // Get the selected option
       var row = $(this).closest('.row');
       var selected_Option = $(this).find('option:selected');
       var prev_purchase_price = selected_Option.attr('data-prev_purchase_price');
       var prev_sale_price = selected_Option.attr('data-prev_sale_price');
       var prev_inventory_qty = selected_Option.attr('data-prev_inventory_qty');

       row.find('.prev_purchase_price').val(prev_purchase_price);
       row.find('.prev_sale_price').val(prev_sale_price);
       row.find('.prev_inventory_qty').val(prev_inventory_qty);
       
	});

	$(document).on('click', '.add-more', function() {	
	    var html = $('.extra-row').html();  // Get the extra row HTML
	    
	    // Append the HTML and find the newly appended row
	    var $newRow = $(html).appendTo('.parent-row');
	    
	    // Initialize Select2 for the .select element inside the newly added row
	    $newRow.find('.select').select2({
	        theme: "bootstrap-5",
	        selectionCssClass: "select2--small",
	        dropdownCssClass: "select2--small"
	    });
	});

	$(document).on('click', '.remove-row', function(){	
        $(this).closest('.main-row').remove();
	});

	$(document).on('click', '.submit', function(e){	
		var validate = checkValidation('#add_inventory');
		if (validate) {

		} else {
			e.preventDefault();
		}
	});
});	