		
		<div class="modal fade party-modal" id="payment-mode-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Party</h5>
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
								<input type="hidden" class="id">
								
								<label for="contact" class="form-label">Contact</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input contact" placeholder="Contact" id="contact" value="" required="">
							</div>
							<div class="col-md-6 mb-3">
								
								<label for="paryt_type" class="form-label">Type</label> <span class="color-red">*</span>
								<select name="party_type" id="party_type" class="form-control validate-input select party_type">
									<option value="">Select</option>
									<option value="Employee">Employee</option>
									<option value="Vender">Vender</option>
									<option value="Customer">Customer</option>
									<option value="Other">Other</option>
								</select>
							</div>

							<div class="col-md-6 mb-3">								
								<label for="note" class="form-label">Note</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input note" placeholder="Note" id="note" value="" required="">
							</div>

							<div class="col-md-12 mb-3">
								<label for="detail" class="form-label">Detail</label>
								<textarea type="textarea" class="form-control detail"  placeholder="Description" id="detail" rows="3" value=""required></textarea>
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>