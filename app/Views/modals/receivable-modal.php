		
		<div class="modal fade receivable-modal" id="item-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Receivable</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">

							<div class="col-md-6 mb-3">
								<input type="hidden" class="receivable_id">
								<label for="account_id" class="form-label">Account</label> <span class="color-red">*</span>
								<select name="account_id" id="account_id" class="form-control validate-input select account_id">
									<option value="">Select</option>
									<?php foreach ($accounts as $row) { ?>
										<option value="<?= $row->account_id;?>"><?= $row->account_name .' ('.$row->type.')';?></option>
									<?php }?>
								</select>
							</div>

							<div class="col-md-6 mb-3">
								<label for="amount" class="form-label">Amount</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input twodecimel amount" placeholder="0.00" id="amount" value="" required="">
							</div>

							<div class="col-md-12 mb-3">
								<label for="receivable_desc" class="form-label">Description</label>
								<textarea type="textarea" class="form-control receivable_desc"  placeholder="Description" id="receivable_desc" rows="5" value=""required></textarea>
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>