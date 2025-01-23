$(document).ready(function() {
    date_initialize();
    function date_initialize(){
        // Define the current date
        const now = new Date();

    	$('.payment_date').datepicker({
            format: 'dd-mm-yyyy',  // Date format (you can adjust this)
            todayHighlight: true,  // Highlight today's date
            autoclose: true,       // Close the datepicker after selecting a date
        });

    	// On focus (click) on the input, reset the calendar to the current month
        // $('.payment_date').on('focus', function() {
        //     $(this).datepicker('setStartDate', new Date(now.getFullYear(), now.getMonth(), 1)); // Reset to current month          
        // });
    }

    $(document).on('click', '.add-more', function(){    
        var html = $('.extra-row').html();
        $('.parent-row').append(html);
        date_initialize()
    });
    $(document).on('click', '.remove-row', function(){  
        $(this).closest('.main-row').remove();
    });

    $(document).on('click', '.submit', function(e){ 
        var validate = checkValidation('#add_payable_form');
        if (validate) {
            var amount = calculateTotalAmount();
            var amount_to_be_paid = parseFloat($('.pending_amount').val());
            amount_to_be_paid = amount_to_be_paid.toFixed(2);

            if (parseFloat(amount_to_be_paid) <= 0) {
                Swal.fire('', 'You can not add more transaction because the peinding amount is zero!', 'error');
                e.preventDefault();
                return false;
            }
            if (parseFloat(amount) > parseFloat(amount_to_be_paid)) {

                
                Swal.fire('', 'The amount entered cannot exceed the pending payable amount. You entered a total of '+amount+', but the pending amount is '+amount_to_be_paid+'', 'error');
                $('.payable_detail_amount').addClass('is-invalid');
                e.preventDefault();
                return false;
            }
        } else {
            e.preventDefault();
        }
    });

    $(document).on('click', '.edit', function(e){ 
        var text = $(this).find('span').text();
        text = text.trim();
        console.log(text);
        if(text == 'Edit') {
            $(this).closest('tr').find('.show').hide();
            $(this).closest('tr').find('.update').show();
            $(this).find('span').text('Update');

        } else {
            $this = $(this);
            var amount_selector = $this.closest('tr').find('.payable_detail_amount');
            var payable_detail_amount = amount_selector.val();
            var old_payable_detail_amount = amount_selector.data('old_val');

            if (payable_detail_amount == '' || parseFloat(payable_detail_amount) == 0) {
                $this.closest('tr').find('.payable_detail_amount').addClass('is-invalid');
                Swal.fire('Amount Required', 'Please enter a valid amount', 'error');
                return false;
            }

            var amount_to_be_paid = parseFloat($('.pending_amount').val());
            amount_to_be_paid = amount_to_be_paid + parseFloat(old_payable_detail_amount);
            // amount_to_be_paid = amount_to_be_paid.toFixed(2);

            if (parseFloat(payable_detail_amount) > parseFloat(amount_to_be_paid)) {
                Swal.fire('', 'The amount entered cannot exceed the pending payable amount. You can update the amount upto '+amount_to_be_paid+'', 'error');
                $('.payable_detail_amount').addClass('is-invalid');
                e.preventDefault();
                return false;
            }
            

            var payable_detail_id = $this.closest('tr').find('.payable_detail_id').val();
            var payment_date = $this.closest('tr').find('.payment_date').val();
            var payment_mode_id = $this.closest('tr').find('.payment_mode_id').val();
            var payment_mode_id_text = $this.closest('tr').find('.payment_mode_id option:selected').text();
            var payable_detail_desc = $this.closest('tr').find('.payable_detail_desc').val();


            Swal.fire({
              title: 'Are you sure you want to update this transaction',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: base + "/payable/update_payment",
                        type: "POST",
                        data: {
                            payable_detail_id: payable_detail_id,
                            payment_date: payment_date,
                            payment_mode_id: payment_mode_id,
                            payable_detail_desc: payable_detail_desc,
                            payable_detail_amount: payable_detail_amount
                        },        
                        success: function(data) {
                            if (data.success) {
                                $this.closest('tr').find('.show').show();
                                $this.closest('tr').find('.update').hide();
                                $this.find('span').text('Edit');

                                $this.closest('tr').find('.payment_date_text').text(payment_date);
                                $this.closest('tr').find('.payment_mode_id_text').text(payment_mode_id_text);
                                $this.closest('tr').find('.payable_detail_desc_text').text(payable_detail_desc);

                                payable_detail_amount_text = payable_detail_amount;
                                payable_detail_amount_text = new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }).format(payable_detail_amount_text);

                                $this.closest('tr').find('.payable_detail_amount_text').text(payable_detail_amount_text);

                                if (parseFloat(data.pending_amount) <= 0) {
                                    Swal.fire('', 'Transaction updated successfully and pending amount is 0!', 'success');
                                } else {
                                    Swal.fire('', 'Transaction updated successfully', 'success');
                                }

                                amount_selector.data('old_val', payable_detail_amount).attr('data-old_val', payable_detail_amount);
                                $this.closest('tr').find('.amount').val(payable_detail_amount);

                                $('.pending_amount').val(data.pending_amount);

                                calculate_total();

                            } else {
                                Swal.fire('', 'Something went wrong! Please try later', 'error');
                            }
                        }
                    }); 

                }
            })
        }
    })

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

    $(document).on('click', '.delete', function(){

        var payable_detail_id = $(this).data('payable_detail_id');
        var tr = $(this).closest('tr');

        Swal.fire({
          title: 'Are you sure you want to delete this transaction',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: base + "/payable/delete_line",
                    type: "POST",
                    data: {
                        payable_detail_id: payable_detail_id,
                    },        
                    success: function(data) {
                        if (data.success) {
                            tr.fadeOut('slow', function() {
                                tr.remove(); // Remove the row from the DOM after fading out

                                var tbody = $('.previous_details_tbody');
                                var rows = $('tr.previous_detail_row');
                                if (rows.length === 0) {
                                    tbody.append(`
                                        <tr>
                                            <td colspan="6" class="text-center">Data not exist.</td>
                                        </tr>
                                    `);
                                }

                                calculate_total();
                            });

                        } else {
                            Swal.fire('', 'Something went wrong! Please try later', 'error');
                        }
                    }
                }); 

            }
        })
    })

})
function calculateTotalAmount() {
    let total = 0; // Initialize total as 0

    $('#add_payable_form .payable_detail_amount').each(function() {
        let value = parseFloat($(this).val()) || 0; // Default to 0 if value is NaN
        total += value;
    });
    return total.toFixed(2);
}