
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
		Inventory Detail
	</h1>


	<!-- BEGIN #datatable -->
	<div id="datatable" class="mb-5">
		<div class="card">
			<div class="card-header bg-none fw-bold">
				<div class="row">
					<div class="col-md-3">	
						<label for="inventory_code" class="form-label">Inventory Code</label> 
						<input type="text" readonly="" class="form-control validate-input inventory_code" id="inventory_code" name="inventory_code" value="<?= $inventory_code ?>" />
					</div>

					<div class="col-md-3">	
						<label for="inventory_date" class="form-label">Inventory Date</label> 
						<input type="text" readonly="" class="form-control validate-input inventory_date" id="inventory_date" name="inventory_date" value="<?= $inventory_date ?>" />
					</div>
				</div>

			</div>
			<div class="card-body">
				<div class="parent-row">
					<div class="row main-row mb-3 main-first-row">
						<div class="col-md-10">
							<div class="row">

								<div class="col-2">
										<label class="form-label">Item</label>
								</div>


								<div class="col-md-2">
									<label class="form-label">Prev Purch Price</label>
								</div>
								<div class="col-md-2">
									<label class="form-label">Prev Sale Price</label>
								</div>
								<div class="col-md-1">
									<label class="form-label">Prev Qty</label>
								</div>
								<div class="col-md-2">
									<label class="form-label">Purchase Price</label>
								</div>
								<div class="col-md-2">
									<label class="form-label">Sale Price</label>
								</div>
								<div class="col-md-1">
									<label class="form-label">Quantity</label>
								</div>
							</div>
						</div>

						<div class="col-md-2">
								<label for="Date" class="form-label" style="visibility: hidden">Date</label>
						</div>
					</div>
				</div>
				<?php 
					$i = 0;
					foreach ($details as $key => $detail) { 
					$i++;
					?>
					<div class="parent-row">
						<div class="row main-row mb-3 main-first-row">
							<div class="col-md-10">
								<div class="row">

									<div class="col-2">
										<select name="item_id[]" class="form-control validate-input select select2 item_id" disabled="">
											<option value="">Select Item</option>
											<?php foreach($items as $row) :?>
												<option value="<?= $row->itemsId ?>" 
													<?=($detail->item_id == $row->itemsId) ? 'selected' : ''?>
												><?= $row->itemName  ?></option>
											<?php endforeach; ?>
										</select>
									</div>


									<div class="col-md-2">
										<input type="text" class="form-control validate-input purchase_price twodecimel" placeholder="0.00" name="purchase_price[]" id="purchase_price" value="<?= $detail->prev_purchase_price ?>" readonly>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control validate-input sale_price twodecimel" placeholder="0.00" name="sale_price[]" id="sale_price" value="<?= $detail->prev_sale_price ?>" readonly>
									</div>
									<div class="col-md-1">
										<input type="text" class="form-control validate-input inventory_qty number" placeholder="0" name="inventory_qty[]" id="inventory_qty" value="<?= $detail->prev_inventory_qty ?>" readonly>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control validate-input purchase_price twodecimel" placeholder="0.00" name="purchase_price[]" id="purchase_price" value="<?= $detail->purchase_price ?>" readonly>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control validate-input sale_price twodecimel" placeholder="0.00" name="sale_price[]" id="sale_price" value="<?= $detail->sale_price ?>" readonly>
									</div>
									<div class="col-md-1">
										<input type="text" class="form-control validate-input inventory_qty number" placeholder="0" name="inventory_qty[]" id="inventory_qty" value="<?= $detail->inventory_qty ?>" readonly>
									</div>
								</div>
							</div>

							<div class="col-md-2">
								<div>
									<button type="button" class="btn btn-outline-theme me-2 print-barcode" 
										data-item_id="<?= $detail->item_id ?>"  
										data-barcode="<?= $detail->barcode ?>"
										data-inventory_qty="<?= $detail->inventory_qty ?>"
										style="width: 100px;">Barcode <i class="fa fa-barcode" aria-hidden="true"></i>
									</button>
									<button type="button" class="btn btn-outline-theme me-2 delete" 
										data-inventory_detail_id="<?= $detail->inventory_detail_id ?>"
										style="width: 80px;">Delete</i>
									</button>
								</div>
							</div>

						</div>
					</div>
				<?php }?>

				<div class="col-md-12 mb-3">
					<label for="inventory_desc" class="form-label">Description</label>
					<textarea type="textarea" readonly name="inventory_desc" class="form-control inventory_desc"  placeholder="Description" id="inventory_desc" rows="5"><?= $inventory_desc ?></textarea>
				</div>

			</div>

			<div class="card-footer bg-none fw-bold">
				<div class="row">
					<div class="col-md-12" style="display: flex;justify-content: end">	
						<a type="btn" href="<?= URL?>/inventory" class="btn btn-outline-theme me-2"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
					</div>
				</div>
			</div>
			<!-- <div class="hljs-container rounded-bottom">
				<pre><code class="xml" data-url="assets/data/table-plugins/code-1.json"></code></pre>
			</div> -->
		</div>

		
	</div>
	<!-- END #datatable -->
</div>

<?php include(APPPATH . 'Views/modals/barcode-modal.php') ?>
