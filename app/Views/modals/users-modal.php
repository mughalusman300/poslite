		
		<div class="modal fade users-modal" id="users-modal">
			<div class="modal-dialog modal-xl">
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
						</div>
						<div class="row">
							<div class="col-md-12" style="display: flex; justify-content: space-between;">
								<b>Permissions</b>
								<div class="form-check form-switch">
		                            <input type="checkbox" class="form-check-input allow_all_permissions" value="allow_all_permissions">
		                            <label class="form-check-label" for="customSwitch2">Allow All Permissions</label>
		                        </div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										<b style="font-weight: 700">Module</b>
									</div>
									<div class="col-md-4">
										<b style="font-weight: 700">View Level</b>
									</div>
									<div class="col-md-4">
										<b style="font-weight: 700">Entry Level</b>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										<b style="font-weight: 700">Module</b>
									</div>
									<div class="col-md-4">
										<b style="font-weight: 700">View Level</b>
									</div>
									<div class="col-md-4">
										<b style="font-weight: 700">Entry Level</b>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										Dashboard
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input" name="permissions[]" value="view_dashboard">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input" name="permissions[]" value="alter_dashboard">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										Sales
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input admin" name="permissions[]" value="view_sales">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input admin" name="permissions[]" value="alter_sales">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										Items
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input user"  name="permissions[]" value="view_item" >
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input user" name="permissions[]" value="alter_item">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										Categories
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input user" name="permissions[]" value="view_category">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input" name="permissions[]" value="alter_category">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										Inventory
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input user" name="permissions[]" value="view_inventory">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input user" name="permissions[]" value="alter_inventory">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										Expense
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input" name="permissions[]" value="view_expense">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input" name="permissions[]" value="alter_expense">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="row mt-3">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										Payment
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input" name="permissions[]" value="view_payment">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input" name="permissions[]" value="alter_payment">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										Party
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input" name="permissions[]" value="view_party">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input" name="permissions[]" value="alter_party">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
								</div>
							</div>
						</div> -->
						<div class="row mt-3">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										Sales Report
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input admin" name="permissions[]" value="view_sale_report">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input admin"  name="permissions[]" value="alter_sale_report">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										Accounts
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input admin" name="permissions[]" value="view_accounts">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input admin" name="permissions[]" value="alter_accounts">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4" style="font-weight: 600">
										System Administration
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input admin" name="permissions[]" value="view_system_administration">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
									<div class="col-md-4">
										<div class="form-check form-switch">
				                            <input type="checkbox" class="form-check-input admin" name="permissions[]" value="alter_system_administration">
				                            <label class="form-check-label" for="customSwitch2"></label>
				                        </div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save" data-type="add">Save</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>