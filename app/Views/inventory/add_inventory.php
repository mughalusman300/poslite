
<!-- BEGIN #content -->
<style type="text/css">
	.datepicker.datepicker-dropdown {
		z-index: 1200 !important;
	}
	.is-invalid {
		border-color: red !important;
	}
</style>

<div id="content" class="app-content">
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
		<li class="breadcrumb-item active">STARTER PAGE</li>
	</ul>
	
	<h1 class="page-header d-flex justify-content-between">
		Add Inventory 
	</h1>


	<!-- BEGIN #datatable -->
	<div id="datatable" class="mb-5">
		<!-- <h4>Categories</h4> -->
		<form id="add_inventory" action="<?=URL?>/inventory/add_inventory" method="POST" enctype="multipart/form-data" class="product-form">
			<div class="card">
				<div class="card-header bg-none fw-bold">
					<div class="row">
						<div class="col-md-3">	
							<label for="inventory_code" class="form-label">Inventory Code</label> 
							<input type="text" readonly="" class="form-control validate-input inventory_code" id="inventory_code" name="inventory_code" value="<?= inventory_code() ?>" />
						</div>

						<div class="col-md-3">	
							<label for="inventory_date" class="form-label">Inventory Date</label> 
							<input type="text" readonly="" class="form-control validate-input inventory_date" id="inventory_date" name="inventory_date" value="<?= date('d-m-Y') ?>" />
						</div>
					</div>

				</div>
				<div class="card-body">
					<div class="parent-row">
						<div class="row main-row mb-3 main-first-row">
							<div class="col-md-11">
								<div class="row">

									<div class="col-3">
										<label class="form-label">Item <span class="text-danger">*</span></label>
										<select name="item_id[]" class="form-control validate-input select select2 item_id">
											<option value="">Select Item</option>
											<?php foreach($items as $row) :?>
												<option value="<?= $row->itemsId ?>"><?= $row->itemName  ?></option>
											<?php endforeach; ?>
										</select>
									</div>



									<div class="col-md-3">
										<label for="purchase_price" class="form-label">Purchase Price</label> <span class="color-red">*</span>
										<input type="text" class="form-control validate-input purchase_price twodecimel" placeholder="0.00" name="purchase_price[]" id="purchase_price" value="" >
									</div>
									<div class="col-md-3">
										<label for="sale_price" class="form-label">Sale Price</label> <span class="color-red">*</span>
										<input type="text" class="form-control validate-input sale_price twodecimel" placeholder="0.00" name="sale_price[]" id="sale_price" value="" >
									</div>
									<div class="col-md-3">
										<label for="inventory_qty" class="form-label">Quantity</label> <span class="color-red">*</span>
										<input type="text" class="form-control validate-input inventory_qty number" placeholder="0" name="inventory_qty[]" id="inventory_qty" value="" >
									</div>
								</div>
							</div>
							<div class="col-md-1">
								<label for="Date" class="form-label" style="visibility: hidden">Date</label>
								<button type="button" class="btn btn-outline-theme me-2 add-more" style="width: 100px;">Add more</button>
							</div>

						</div>
					</div>

					<div class="col-md-12 mb-3">
						<label for="inventory_desc" class="form-label">Description</label>
						<textarea type="textarea" name="inventory_desc" class="form-control inventory_desc"  placeholder="Description" id="inventory_desc" rows="5" value=""></textarea>
					</div>

				</div>

				<div class="card-footer bg-none fw-bold">
					<div class="row">
						<div class="col-md-12" style="display: flex;justify-content: end">	
							<button type="submit" class="btn btn-outline-theme me-2 submit">Submit</button>
						</div>
					</div>
				</div>
				<!-- <div class="hljs-container rounded-bottom">
					<pre><code class="xml" data-url="assets/data/table-plugins/code-1.json"></code></pre>
				</div> -->
			</div>
		</form>

		<div class="extra-row" style="display:none ;">
			<div class="row main-row mb-3">
				<div class="col-md-11">
					<div class="row">

						<div class="col-3">
							<select name="item_id[]" class="form-control validate-input select item_id">
								<option value="">Select Item</option>
								<?php foreach($items as $row) :?>
									<option value="<?= $row->itemsId ?>"><?= $row->itemName  ?></option>
								<?php endforeach; ?>
							</select>
						</div>



						<div class="col-md-3">
							<input type="text" class="form-control validate-input purchase_price twodecimel" placeholder="0.00" name="purchase_price[]" id="purchase_price" value="" >
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control validate-input sale_price twodecimel" placeholder="0.00" name="sale_price[]" id="sale_price" value="" >
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control validate-input inventory_qty number" placeholder="0" name="inventory_qty[]" id="inventory_qty" value="" >
						</div>
					</div>
				</div>
				<div class="col-md-1">
					<button type="button" class="btn btn-outline-theme me-2 remove-row" style="width: 100px;">Remove</button>
				</div>

			</div>
		</div>

		
	</div>
	<!-- END #datatable -->
</div>