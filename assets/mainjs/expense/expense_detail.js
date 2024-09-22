$(document).ready(function() {
	$(document).on('click', '.update-status', function(){
		var expense_id = $(this).attr('data-expense_id');
		var expense_detail_id = $(this).attr('data-expense_detail_id');
		var type = $(this).attr('data-type');
		$this = $(this);

		var mydata = {expense_id: expense_id, expense_detail_id: expense_detail_id, type: type};
		$.ajax({
			url: base + "/expense/update_expense_detail_status",
			type: "POST",
			data: mydata,        
			success: function(data) {
			    if (data.success) {
				    Swal.fire('', data.msg, 'success');
			    	if(type == 'approve') {
			    		$this.closest('.main-col').find('.pending-div').addClass('d-none');
			    		$this.closest('.main-col').find('.approved-div').removeClass('d-none');
			    	}
			    	if(type == 'reject') {
			    		$this.closest('.main-col').find('.pending-div').addClass('d-none');
			    		$this.closest('.main-col').find('.rejected-div').removeClass('d-none');
			    	}
			    	if(data.total_expense != data.pending_expense){
			    		$('.approve_all').remove();
			    	}
				}
			}
		});	
	})

	$(document).on('click', '.approve_all', function(){
		var expense_id = $(this).attr('data-expense_id');
		var mydata = {expense_id: expense_id};

		Swal.fire({
		  title: 'Are you sure you want to approve all?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, approve all!'
		}).then((result) => {
		  	if (result.isConfirmed) {
       			$.ajax({
       				url: base + "/expense/approve_all_expense",
       				type: "POST",
       				data: mydata,        
       				success: function(data) {
       				    if (data.success) {
       					    location.reload();
       					}
       				}
       			});	
		  	}
		})
	});
});