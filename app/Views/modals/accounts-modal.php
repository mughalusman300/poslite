		
		<div class="modal fade accounts-modal" id="accounts-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Account</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-4">
								<input type="hidden" class="account_id">
								
								<label for="account_name" class="form-label">Account Name</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input account_name" placeholder="Account Name" id="account_name" value="" required="">
							</div>
							<div class="col-md-4">
								<label for="type" class="form-label">Party</label> <span class="color-red">*</span>
								<select class="form-control validate-input party_id" id="party_id" value="" required="">
									<option value="">Select</option>
									<?php foreach ($parties as $party) { ?>
										<option value="<?= $party->id ?>"><?= $party->name ?> | <?= $party->party_type ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-4">
								<label for="account_type" class="form-label">Type</label> <span class="color-red">*</span>
								<select class="form-control validate-input account_type" id="account_type" value="" required="">
									<option value="">Select</option>
									<option value="Payable">Payable</option>
									<option value="Receivable">Receivable</option>
								</select>
							</div>

							<div class="col-md-12 mb-3">
								<label for="account_desc " class="form-label">Description</label>
								<textarea type="textarea" class="form-control account_desc "  placeholder="Description" id="account_desc" rows="5" value=""required></textarea>
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>