$(document).ready(function() {

	var tagitInstance = $("#tags").data("ui-tagit");
	// Add the new tags
	for (var i = 0; i < saved_tags.length; i++) {
	  tagitInstance.createTag(saved_tags[i]);
	}


	function keywords(){
		var values = '';
		var keywordsValues = $('.keywords-ul').find('.tagit-choice');
		var length = keywordsValues.length;
		var counter = 1;
		$('.variant-tbody').html('');
		keywordsValues.each(function() {
			var value = $(this).find('.tagit-label').text();
			if (value != '') {
				if(counter < length) {
					values += value + ',';
				} else {
					values += value;
				}
			}
			counter++;
		});

		$('.keywords').val(values);
	}
	
	$(document).on('click', '.save', function(){	
		keywords();

		console.log($('.keywords').val());
		var validate = checkValidation('.add-product');
		if(!validate) {
			return false;
		}
	});

	$(document).on('click', '.add-more-image', function(){
		var html = `<div class="main-row col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-2">
						<div class="row">
							<div class="product-upload-radio-btn-div text-center">
								<div class="form-check form-switch mt-1">
	                            	<input type="checkbox" class="form-check-input default" name="default" value="1">
									<input type="hidden" class="default_image" name="default_image" value="">
									<input type="hidden" class="attachment_id" name="attachment_id" value="">
	                        	</div>
							</div>

							<div class="product-upload-img-div upload-row text-end">
								<div class="img-col">
									<img  class="img-preview product-img-preview" style="display: none;" title="Click here to remove this file" src="">
								</div>
								<button
									style="display: none;" 
									type="button" 
									class="btn btn-sm btn-outline-danger remove-img mt-2"
									data-attachment_id=""
								>
									Delete
								</button>
								<input type="file" name="product_img[]" id="product_img" placeholder=" Attachments" class="form-control attachment-file  product_img" accept="gif, .jpg, .png," style="display: none">

								<button type="button" class=" btn btn-default btn-browse product-upload-btn form-control" >
				                    <i class="fa fa-cloud-upload"></i>
				                    Uploade Image           
				                </button>
							</div>
						</div>
					</div>`;

		$('.image-parent-div').append(html);
	});

	$(document).on('change',".default",function (e) {
		$('.default_image').val('');

		if ($(this).prop("checked", true)) {
			$(this).closest('div').find('.default_image').val(1);
			var attachment_id = $(this).closest('div').find('.attachment_id').val();
			var product_id = $('.product_id').val();
			if (attachment_id != '') {
				$.ajax({
					url: base + "/product/default_image",
					type : 'post',
					'async': true,
					data : {product_id: product_id, attachment_id: attachment_id},
					success : function(data) {
					    if (data.success) {
					    	Swal.fire('Default Image!', 'Image set default successfully!', 'success');
						}
					}
				});
			}
		}

		$('.default').prop('checked', false);
		$(this).prop("checked", true);
	});
	$(document).on('click',".img-preview",function (e) {
		var selector = $(this);

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
       			selector.parents('.upload-row').find('.attachment-file').val('');
       			selector.parents('.upload-row').find('.btn-browse ').show();
	            selector.hide();
		  	}
		})

	});

	$(document).on('click',".remove-img",function (e) {
		var selector = $(this);
		var attachment_id = selector.data('attachment_id');

		if (attachment_id != '') {
			Swal.fire({
			  title: 'Are you sure?',
			  text: "Image will be delete Permanently",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			  	if (result.isConfirmed) {
			  		var mydata = {attachment_id: attachment_id};
	       			$.ajax({
	       				url: base + "/product/remove_image",
	       				type: "POST",
	       				data: mydata,        
	       				success: function(data) {
	       				    if (data.success) {
	       					    Swal.fire('Delete Image!', 'Image Deleted Successfully!', 'success');
	       					    selector.closest('.main-row').remove();
	       					}
	       				}
	       			});	
			  	}
			})
		} else {
			selector.closest('.main-row').remove();
		}

	});
	$(document).on("change", ".attachment-file", function (e) {
		var fd = new FormData(); 
        var files = $(this)[0].files[0]; 
        var default_image = $(this).closest('.row').find('.default_image').val();
        var attachment_id_selector = $(this).closest('.row').find('.attachment_id');
        var remove_img_selector = $(this).closest('.row').find('.remove-img');
        var product_id = $('.product_id').val();
        fd.append('file', files); 
        fd.append('default_image', default_image); 
        fd.append('product_id', product_id); 

			$.ajax({
				url: base + "/product/add_image",
				type : 'post',
				'async': true,
				data : fd,
				cache:false,
				'processData': false,  // tell jQuery not to process the data
				'contentType': false,  // tell jQuery not to set contentType
				success : function(data) {
				    if (data.success) {
					    Swal.fire('Add Image!', 'Image added successfully!', 'success');
					    attachment_id_selector.val(data.attachment_id);
					    remove_img_selector.attr('data-attachment_id', data.attachment_id)
					}
				}
			});
	});

	$(document).on('click',".img-preview",function (e) {
		var selector = $(this);

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
       			selector.parents('.upload-row').find('.attachment-file').val('');
       			selector.parents('.upload-row').find('.btn-browse ').show();
	            selector.hide();
		  	}
		})

	});

})