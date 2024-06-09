		
		<div class="modal fade uom-modal" id="uom-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add UOM</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" class="uom_id">
								
								<label for="uom_name" class="form-label">Name</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input uom_name" placeholder="Name" id="uom_name" value="" required="">
							</div>

							<div class="col-md-6">
								<label for="uom_code" class="form-label">UOM Code</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input uom_code uppercase" placeholder="UOM Code" id="uom_code" value="" required="">
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save mt-3" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>