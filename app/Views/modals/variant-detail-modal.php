		
		<div class="modal fade variant-detail-modal" id="variant-detail-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Variant Line</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" class="variant_detail_id">
								
								<label for="variant_detail_name" class="form-label">Name</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input variant_detail_name" placeholder="Name" id="variant_detail_name" value="" required="">
							</div>

							<div class="col-md-12 mb-3">
								<label for="variant_detail_desc" class="form-label">Description</label>
								<textarea type="textarea" class="form-control variant_detail_desc"  placeholder="Description" id="variant_detail_desc" rows="5" value=""required></textarea>
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>