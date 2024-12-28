$(document).ready(function(){
	select2('.select2');
	tabToEnter();
	function tabToEnter(){
	    $('.main-row :input').on('keydown', function(e) {
	        if (e.key === 'Enter') {
	            e.preventDefault(); // Prevent the default Enter behavior
	            const focusable = $('.main-row')
	                .find(':input:visible:not([readonly]):not([disabled])') // Exclude readonly and disabled inputs
	                .add('.select2-selection'); // Include Select2 elements

	            const index = focusable.index(this); // Get the current element's index

	            // Check if the current element is inventory_qty input
	            if ($(this).hasClass('inventory_qty')) {
	                // If we're on an inventory_qty input, move focus to the add-more button
	                const addMoreButton = $('.add-more');
	                if (addMoreButton.length) {
	                    addMoreButton.focus(); // Focus the add-more button
	                }
	            } else if (index > -1 && index < focusable.length - 1) {
	                const nextElement = focusable.eq(index + 1);
	                if (!$(this).is('button')) {
	                    if (nextElement.hasClass('select2-selection')) {
	                        // Open Select2 dropdown
	                        nextElement.trigger('focus').trigger('click');
	                    } else {
	                        nextElement.focus(); // Move focus to the next element
	                    }
	                }
	            } else if ($(this).is('button') && $(this).hasClass('add-more')) {
	                // $(this).trigger('click'); // Trigger click only if the button has the class 'add-more'

	                // // After triggering the click, move focus to the next element
	                // const focusable = $('.main-row')
	                //     .find(':input:visible:not([readonly]):not([disabled])') // Recompute focusable elements after dynamic addition
	                //     .add('.select2-selection'); // Include Select2 elements
	                // const index = focusable.index(this); // Recalculate index
	                // if (index > -1 && index < focusable.length - 1) {
	                //     const nextElement = focusable.eq(index + 1);
	                //     if (nextElement.length) {
	                //         nextElement.focus(); // Move focus to the next element
	                //     }
	                // }
	            }
	        }
	    });

	    $('.main-row').on('select2:select', function(e) {
	        // Find the closest parent row
	        const parentRow = $(e.target).closest('.parent-row');
	        const targetInput = parentRow.find('.purchase_price');
	        targetInput.focus();
	    });
	}

		$(document).on('keydown', '.add-more', function() {
           if (event.key === "Enter") {
               $(".add-more").click();
           }
       });


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
	    
	    // Focus the first input of the new row
	    $newRow.find('.select').focus();

	    // Re-bind the Enter key navigation for the newly added row
	    tabToEnter();
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