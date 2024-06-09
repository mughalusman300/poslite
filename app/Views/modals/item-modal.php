		
		<div class="modal fade item-modal" id="item-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add item</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6 mb-3">
								<input type="hidden" class="itemsId">
								
								<label for="itemName" class="form-label">Name</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input itemName" placeholder="Name" id="itemName" value="" required="">
							</div>

							<div class="col-md-6 mb-3">
								<label for="itemCategory" class="form-label">Category</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input itemCategory" placeholder="Category" id="itemCategory" value="" required="">
							</div>
							<div class="col-md-4">
								<label for="purchasePrice" class="form-label">Purchase Price</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input twodecimel purchasePrice" placeholder="Purchase Price" id="purchasePrice" value="" required="">
							</div>
							<div class="col-md-4">
								<label for="salePrice" class="form-label">Sale Price</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input twodecimel salePrice" placeholder="Sale Price" id="salePrice" value="" required="">
							</div>
							<div class="col-md-4 mb-3">
								<label for="discount" class="form-label">Discount%</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input twodecimel discount" placeholder="Discount" id="discount" value="" required="">
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>