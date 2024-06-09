		
		<div class="modal fade location-modal" id="location-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Location</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" class="location_id">
								
								<label for="location_name" class="form-label">Name</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input location_name" placeholder="Name" id="location_name" value="" required="">
							</div>


							<div class="col-md-6">
								<label class="form-label">City</label><span class="color-red">*</span>
								<select name="location_city" id="location_city" class="form-control validate-input select location_city">
									<option value="">Select</option>
									<?php foreach(cities as $city) :?>
										<option value="<?= $city ?>"><?= $city ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="col-md-6">
								<label class="form-label">Country</label><span class="color-red">*</span>
								<select name="location_country" id="location_country" class="form-control validate-input select location_country">
									<option value="">Select</option>
									<?php foreach(countries as $country) :?>
										<option value="<?= $country ?>"><?= $country ?></option>
									<?php endforeach; ?>
								</select>
							</div>



							<div class="col-md-12 text-end">
								<button type="button" class="btn btn-theme mb-1 save mt-4" data-type="add">Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>