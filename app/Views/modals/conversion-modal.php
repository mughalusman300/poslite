		
		<div class="modal fade conversion-modal" id="conversion-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Conversion</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">

						<form action="<?=URL?>/Product/add_conversion" method="POST" enctype="multipart/form-data" class="product-form">
							<input type="hidden" name="product_id" class="product_id">
							<input type="hidden" name="purch_unit" class="purch_unit">
							<input type="hidden" name="inv_unit" class="inv_unit">
							<input type="hidden" name="sale_unit" class="sale_unit">
							<input type="hidden" name="type" class="type">

							<div class="card purch-inv-conversion d-none">
							  	<div class="card-header">
							    	<h5> Purchase to Inventory Conversion </h5>
							  	</div>

							  	<div class="card-body">
									<div class="row">
										<div class="col-md-4">
											<label class="form-label">Big Unit</label><span class="color-red">*</span>
											<select name="big_unit" id="big_unit" class="form-control validate-input select big_unit">
											</select>
											<span style="position: absolute; top: 100px; left: 252px"> = </span>
										</div>

										<div class="col-md-4">
											<label for="small_unit_qty" class="form-label">Small Unit Quantity</label> <span class="color-red">*</span>
											<input type="text" class="form-control validate-input number small_unit_qty" name="small_unit_qty" placeholder="Qty" id="small_unit_qty" value="" required="">
										</div>


										<div class="col-md-4">
											<label for="small_unit" class="form-label">Small Unit</label>
											<input type="text" class="form-control small_unit" name="small_unit"  readonly placeholder="Small Unit" id="small_unit" value="" required="">
										</div>

									</div>
							  	</div>
							</div>


							<div class="card inv-sale-conversion d-none mt-3">
							  	<div class="card-header">
							    	<h5> Inventory to Sale Conversion </h5>
							  	</div>
							  
							  	<div class="card-body">
								  	<div class="row">
								  		<div class="col-md-4">
								  			<label class="form-label">Big Unit</label><span class="color-red">*</span>
								  			<select name="big_unit_2" id="big_unit_2" class="form-control validate-input select big_unit_2">
								  			</select>
								  			<span style="position: absolute; top: 100px; left: 252px"> = </span>
								  		</div>

								  		<div class="col-md-4">
								  			<label for="small_unit_qty_2" class="form-label">Small Unit Quantity</label> <span class="color-red">*</span>
								  			<input type="text" class="form-control validate-input number small_unit_qty_2" name="small_unit_qty_2" placeholder="Small Unit" id="small_unit_qty_2" value="" required="">
								  		</div>

								  		<div class="col-md-4">
								  			<label for="small_unit_2" class="form-label">Small Unit</label>
								  			<input type="text" class="form-control small_unit_2" name="small_unit_2"  readonly placeholder="Small Unit" id="small_unit_2" value="" required="">
								  		</div>

								  	</div>
							  	</div>
							</div>

							<div class="col-md-12 text-end">
					  			<button type="button" class="btn btn-theme mb-1 save mt-4" data-type="add">Save</button>
					  		</div>
					  	</form>

					</div>
				</div>
			</div>
		</div>