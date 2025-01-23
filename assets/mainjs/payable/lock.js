$(document).ready(function() {
    calculate_total();

    function calculate_total(){
        let total_approved = 0; // Initialize total as 0
        let total_pending_approval = 0; // Initialize total as 0
        let total_rejected = 0; // Initialize total as 0
        let total_pending = 0; // Initialize total as 0

        let total_amount = $('.total_amount').val();
        $('.amount').each(function() {
            let value = parseFloat($(this).val()) || 0; // Default to 0 if value is NaN
            var is_lock = $(this).attr('data-is_lock');
            var is_rejected = $(this).attr('data-is_rejected');
            if (is_lock == 1) {
                total_approved += value;
            } else if (is_rejected == 1) {
            	total_rejected += value;
            } else if (is_lock != 1 && is_rejected != 1) {
                total_pending_approval += value;
            }
        });

        total_pending = total_amount - total_approved - total_pending_approval;
        if(total_pending <= 0) {
            total_pending = 0;
        }
        if(total_approved >= total_amount) {
        // console.log(total_approved+'' +total_amount)
            $('.complete').show();
        } else {
            $('.complete').hide();

        }

        // Format total_approved with thousands separator and two decimal places
        total_approved = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(total_approved);

        total_pending_approval = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(total_pending_approval);

        total_rejected = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(total_rejected);

        total_pending = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(total_pending);

        // Update the approved amount display
        $('.approved-amount').text(total_approved);
        $('.pending-approval').text(total_pending_approval);
        $('.rejected-amount').text(total_rejected);
        $('.pending-amount').text(total_pending);
    }

    $(document).on('click',".update-status",function (e) {
        var selector = $(this);
    	var tr = $(this).closest('tr');
    	var payable_detail_id = selector.attr('data-payable_detail_id');
    	var type = selector.attr('data-type');
    	var alert_msg = 'Are you sure you want to '+type+' this transaction';

    	Swal.fire({
    	  title: alert_msg,
    	  text: "You won't be able to revert this!",
    	  icon: 'warning',
    	  showCancelButton: true,
    	  confirmButtonColor: '#3085d6',
    	  cancelButtonColor: '#d33',
    	  confirmButtonText: 'Yes, do it!'
    	}).then((result) => {
    	  	if (result.isConfirmed) {
    	  		$.ajax({
    	  			url: base + "/payable/update_satus",
    	  			type: "POST",
    	  			data: {payable_detail_id: payable_detail_id, type: type},        
    	  			success: function(data) {
    	  			    if (data.success) {
       						Swal.fire('', 'Transaction '+type+'ed Successfully', 'success');
       						selector.closest('td').html(data.html);
       						if (type == 'lock') {
                                // debugger;
	       						tr.find('.amount').data('is_lock', 1).attr('data-is_lock', 1);
       						} else {
                                tr.find('.amount').data('is_rejected', 1).attr('data-is_rejected', 1);
       						}
       						
                            calculate_total();
    	  				} else {
    	  					Swal.fire('', 'Something went wrong! Please try later', 'error');
    	  				}
    	  			}
    	  		});	

    	  	}
    	})

    });

    $(document).on('click',".revert",function (e) {
        var selector = $(this);
        var tr = $(this).closest('tr');
        var payable_detail_id = selector.attr('data-payable_detail_id');
        var alert_msg = 'Are you sure you want to revert this transaction status';

        Swal.fire({
          title: alert_msg,
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base + "/payable/update_satus",
                    type: "POST",
                    data: {payable_detail_id: payable_detail_id, type: 'revert'},        
                    success: function(data) {
                        if (data.success) {
                            Swal.fire('', 'Transaction status revert successfully', 'success');
                            selector.closest('td').html(data.html);
                            tr.find('.amount').data('is_lock', 0).attr('data-is_lock', 0);
                            tr.find('.amount').data('is_rejected', 0).attr('data-is_rejected', 0);
                            calculate_total();
                        } else {
                            Swal.fire('', 'Something went wrong! Please try later', 'error');
                        }
                    }
                }); 

            }
        })

    });

    $(document).on('click',".complete",function (e) {
        var selector = $(this);
        var payable_id = selector.attr('data-payable_id');
        var alert_msg = 'Are you sure you want to mark this transaction complete';

        Swal.fire({
          title: alert_msg,
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base + "/payable/complete",
                    type: "POST",
                    data: {payable_id: payable_id},        
                    success: function(data) {
                        if (data.success) {
                            Swal.fire('', 'Transaction marked complted successfully', 'success');
                            setTimeout(function(){
                                let url = base + "/payable/completed";
                                window.location = url
                            },1500);
                            
                        } else {
                            Swal.fire('', 'Something went wrong! Please try later', 'error');
                        }
                    }
                }); 

            }
        })

    });
});
