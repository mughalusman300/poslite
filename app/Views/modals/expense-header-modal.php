		
		<div class="modal fade expense-header-modal" id="expense-header-modal">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Expense Header</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12 mb-3">
								<input type="hidden" class="id">
								
								<label for="name" class="form-label">Name</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input name" placeholder="Name" id="name" value="" required="">
							</div>

							<div class="col-md-12 mb-3">
								<label for="header_desc" class="form-label">Description</label>
								<textarea type="textarea" class="form-control header_desc"  placeholder="Description" id="header_desc" rows="5" value=""required></textarea>
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>