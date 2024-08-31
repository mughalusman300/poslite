		
		<div class="modal fade payment-mode-modal" id="payment-mode-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Payment Mode</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6 mb-3">
								<input type="hidden" class="id">
								
								<label for="name" class="form-label">Name</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input name" placeholder="Name" id="name" value="" required="">
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Type</label><span class="color-red">*</span>
								<select name="payment_type" id="payment_type" class="form-control validate-input select payment_type">
									<option value="">Select</option>
									<option value="Bank Transfer">Bank Transfer</option>
									<option value="Cheque">Cheque</option>
									<option value="Cash">Cash</option>
									<option value="Other">Other</option>
								</select>
							</div>

							<div class="col-md-12 mb-3">
								<label for="payment_mode_desc" class="form-label">Description</label>
								<textarea type="textarea" class="form-control payment_mode_desc"  placeholder="Description" id="payment_mode_desc" rows="3" value=""required></textarea>
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>