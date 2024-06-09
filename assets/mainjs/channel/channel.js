$(document).ready(function(){
	
	categoryList();

	var table = $('#channel').DataTable({
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
	     	"url": base +"/channel/channelList",
	     	"dataType": "json",
	     	"type": "POST",
	    },
    	"columns": [
	        { "data": "sr" },
	        { "data": "Name" },
	        { "data": "Email" },
	        { "data": "Phone" },
			{ "data": "Address" },
	        { "data": "status" },
	        { "data": "Action" },
	    ],
    	"columnDefs": [
        	{ targets: 0, width: '150px' },
        	{ targets: 1, width: '200px' },
        	{ targets: 2, width: '200px' },
        	{ targets: 3, width: '200px' },
        	{ targets: 4, width: '200px' },
			{ targets: 5, width: '200px' },
        ]
    });

	function channelList()
	{

	}
	
});