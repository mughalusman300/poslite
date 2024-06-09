		
		<div class="modal fade group-modal" id="group-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Group</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" class="category_id">
								
								<label for="title" class="form-label">Name</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input group_name" placeholder="Name" id="group_name" value="" required="">
							</div>


							<div class="col-md-12 mb-3">
								<label for="desc" class="form-label">Description</label>
								<textarea type="textarea" class="form-control group_desc"  placeholder="Description" id="group_desc" rows="5" value=""required></textarea>
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>