		
		<div class="modal fade users-modal" id="users-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add user</h5>
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
								<label for="email" class="form-label">Email</label> <span class="color-red">*</span>
								<input type="email" class="form-control validate-input email" placeholder="Email" id="email" value="" required="">
							</div>
							<div class="col-md-6">
								<label for="power" class="form-label">Power</label> <span class="color-red">*</span>
								<select class="select form-control validate-input power" >
									<option value="">Select</option>
									<option value="admin">Admin</option>
									<option value="user">User</option>
								</select>
							</div>
							<div class="col-md-6 mb-3">
								<label for="password" class="form-label">Password</label> <span class="color-red">*</span>
								<input type="password" autocomplete="false" class="form-control validate-input password" placeholder="Password" id="password" value="" required="">
							</div>

							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>