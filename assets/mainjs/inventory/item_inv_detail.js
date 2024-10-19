$(document).ready(function(){
	invntoryList();

	function invntoryList(search =''){
		var item_id = $('.item_id').val();
		var table = $('#inv_detail').DataTable({
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
		     	"url": base +"/inventory/itemInvDetailList",
		     	"dataType": "json",
		        "data":{ item_id: item_id, search: search },
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "sr" },
		        { "data": "inventory_qty" },
		        { "data": "purchase_price" },
		        { "data": "sale_price" },
		        { "data": "date" },
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
			var table = $('#inv_detail').dataTable();
			var search = $(".search").val();
			table.fnDestroy();
			invntoryList(search);	
			// $('#category_id').val(cat).trigger('change.select2');
			// $('#mat_category').val(mat_cat).trigger('change.select2');
	});
});
