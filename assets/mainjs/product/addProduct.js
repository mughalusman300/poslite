$(document).ready(function() {
	// $('.select2').editableSelect({ effects: 'default' });
	// $('.select2').select2({
	// 	theme: "classic"
	// });

	function option_values(){

		setTimeout(function(){
			var values = '';
			var optionValues = $('.option-values-ul').find('.tagit-choice');
			var length = optionValues.length;
			var counter = 1;
			$('.variant-tbody').html('');
			optionValues.each(function() {
				var value = $(this).find('.tagit-label').text();
				if (value != '') {
					var variant_html = setVariantHtml(value);
					$('.variant-tbody').append(variant_html);
					if(counter < length) {
						values += value + ',';
					} else {
						values += value;
					}
				}
				counter++;
			});
			$('.option_values').val(values);

		},300);
	}
	
	$( ".option-values-ul .ui-autocomplete-input" ).focusout(function() {
		option_values();
	});
	$( ".option-values-ul .ui-autocomplete-input" ).keydown(function(event) {
		if (event.keyCode == 9 || event.keyCode == 32 || event.keyCode == 13 || event.keyCode == 8) {
			option_values();
		}
	});

	$(document).on('click', '.option-values-ul .tagit-close', function(){	
		console.log('in');
		$(this).closest('li').remove();
		option_values();
	});

	function setVariantHtml(value) {
		var html = `<tr>
						<td class="align-middle">
							<div class="form-check">
								<input type="checkbox" name="variant[0][enabled]" id="variant_0_enabled" value="1" checked class="form-check-input">
								<label class="form-check-label">&nbsp;</label>
							</div>
						</td>
						<td class="align-middle">
							<span class="text-theme">${value}</span>
						</td>
						<td><input type="text" class="form-control dashspecialvalidation" value="" placeholder="#SKU000001"></td>
						<td><input type="text" class="form-control twodecimel" value="" placeholder="0.00"></td>
						<td><input type="text" class="form-control number" value="" placeholder="0"></td>
					</tr>`;
		return html;
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

		console.log(values);

		$('.keywords').val(values);

	}
	
	$(document).on('click', '.save', function(){	
		// console.log('ttdd');
		keywords();
		// console.log('dd');
		var validate = checkValidation('.add-product');
		if(!validate) {
			return false;
		}
	});

	$(document).on('click', '.v1', function(){	
		var v1 = $('.v1').val();
		var v2 = $('.v2').val();
		var v3 = $('.v3').val();

		if (v1 != ''){
			if (v1 == v2 || v1 == v3){
				$(this).addClass('is-invalid');

				Swal.fire('Already Selected', v1+' is already selected please try with different variant', 'error');
				$(this).val('');
			}
		}
	});

	$(document).on('click', '.v2', function(){	
		var v1 = $('.v1').val();
		var v2 = $('.v2').val();
		var v3 = $('.v3').val();

		if (v2 != ''){
			if (v2 == v1 || v2 == v3){
				$(this).addClass('is-invalid');

				Swal.fire('Already Selected', v2+' is already selected please try with different variant', 'error');
				$(this).val('');
			}
		}
	});

	$(document).on('click', '.v3', function(){	
		var v1 = $('.v1').val();
		var v2 = $('.v2').val();
		var v3 = $('.v3').val();

		if (v3 != ''){
			if (v3 == v1 || v3 == v2){
				$(this).addClass('is-invalid');

				Swal.fire('Already Selected', v3+' is already selected please try with different variant', 'error');
				$(this).val('');
			}
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
									<div style="width: 100%" class="img-col">
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

	$(document).on('click',".remove-img",function (e) {
		$(this).closest('.main-row').remove();
	})

	$(document).on('change',".default",function (e) {
		$('.default_image').val('');

		if ($(this).prop("checked", true)) {
			$(this).closest('div').find('.default_image').val(1);
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

})