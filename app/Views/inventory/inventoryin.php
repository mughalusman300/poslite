	
	<!-- BEGIN #content -->
	<div id="content" class="app-content">
		<div class="d-flex align-items-center mb-3">
			<div>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:;">PAGES</a></li>
					<li class="breadcrumb-item active">PRODUCT DETAILS</li>
				</ol>
				<h1 class="page-header mb-0">Inventory In</h1>
			</div>
		</div>
		
		<form action="<?=URL?>/Inventory/create" method="POST" id="inventory-in-form" enctype="multipart/form-data" class="inventory-in-form">
			<div class="row gx-4 add-inventory">
				<div class="col-xl-12">
					<div class="card mb-4">
						<div class="card-header bg-none fw-bold">
							Product Information
						</div>
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-3">
									<label class="form-label">Product <span class="text-danger">*</span></label>
									<select name="product_id" id="product_id" class="form-control validate-input select select2 product_id">
										<option value="">Select Product</option>
										<?php foreach($products as $row) :?>
											<option value="<?= $row->product_id ?>"><?= $row->product_name ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="col-3">
									<label class="form-label">Supplier<span class="text-danger">*</span></label>
									<select name="supplier_id" id="supplier_id" class="form-control validate-input select select2 supplier_id">
										<option value="">Select Supplier</option>
										<option value="1"> Intel Corporation.</option>
									</select>
								</div>
								<div class="col-3">
									<label class="form-label">Location<span class="text-danger">*</span></label>
									<select name="location_id" id="location_id" class="form-control validate-input select select2 location_id">
										<option value="">Select Product</option>
										<?php foreach($locations as $row) :?>
											<option value="<?= $row->location_id ?>"><?= $row->location_name ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-3">
									<label class="form-label">Date <span class="text-danger"></span></label>
									<input type="text" readonly value="<?= date('Y-m-d')?>" class="form-control date" name="date">
								</div>
							</div>

							<div class="response">
							</div>
							<div><button type="button" class="btn btn-theme" style="display: none;">Submit </button></div>
							<!-- <div class="">
								<label class="form-label">Description <span class="text-danger">*</span></label>
								<textarea class="summernote validate-input product_desc" name="product_desc" rows="10"></textarea>
							</div> -->
						</div>
					</div>

				</div>
			</div>
		</form>
	</div>
	<!-- END #content -->
