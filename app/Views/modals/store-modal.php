		
		<div class="modal fade store-modal" id="store-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add store</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" class="store_id">
								
								<label for="store_name" class="form-label">Name</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input store_name" placeholder="Name" id="store_name" value="" required="">
							</div>


							<div class="col-md-6">
								<label for="store_code" class="form-label">Code</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input store_code uppercase" placeholder="Name" id="store_code" value="" required="">
							</div>

							<div class="col-md-6">
								<label for="store_phone" class="form-label">Phone</label>
								<input type="text" class="form-control store_phone" placeholder="Name" id="store_phone" value="" required="">
							</div>



							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save mt-4" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>