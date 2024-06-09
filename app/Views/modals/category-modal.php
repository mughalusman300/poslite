		
		<div class="modal fade category-modal" id="category-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Category</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" class="category_id">
								
								<label for="title" class="form-label">Title</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input cat_title" placeholder="Title" id="cat_title" value="" required="">
							</div>

							<div class="col-md-6">
								<label for="code" class="form-label">Code</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input code uppercase" placeholder="Code" id="code" value="" required="">
							</div>

							<div class="col-md-12 mb-3">
								<label for="desc" class="form-label">Description</label>
								<textarea type="textarea" class="form-control desc"  placeholder="Description" id="desc" rows="5" value=""required></textarea>
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>