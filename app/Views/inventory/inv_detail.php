
<!-- BEGIN #content -->
<div id="content" class="app-content">
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
		<li class="breadcrumb-item active">STARTER PAGE</li>
	</ul>
	
	<div class="page-header d-flex justify-content-between">
		<div class="d-flex align-items-end">
	        <div class="w-70px h-70px bg-gray-100">
	            <img alt="" class="mw-100 mh-100" src="<?= $img ?>">
	        </div>
	        <div class="ms-3">
	            <a href="<?= $proudct_detail ?>" target="_blank"><?= $product_name ?></a>
	            <small class="d-flex"><?= $variation; ?></small>
	        </div>


	    </div>
	    <div class="fs-5 d-flex align-items-end">
	        <?php if($barcode != ''):?>
		        <div class="bar-code-view ms-4">
		        	<div class="row">
		        		<div class="col-10" style="font-size: 12px;text-align: center">
					        <div style="font-weight: bold;color:#333"><?= $product->product_code ?></div>
				            <img src="<?= URL?>/pdf/<?= $barcode?>.png" alt="barcode">
					    </div>
					    <div class="col-2"  style="vertical-align: middle;">
				        	<div class="">
					            <a href="<?= URL?>/inventory/product_barcode/<?= $full_barcode ?>" target="_blank" class="printimg">
					                <img src="<?= URL?>/assets/img/icon/printer.svg" alt="print">
					            </a>
					        </div>
					    </div>
					</div>
		        </div>
		    <?php endif;?>
	    </div>
		<!-- <a type="button" href="<?= URL?>/product/add" class="btn btn-outline-theme me-2 add-product">Inventory List</a> -->
		<!-- Categories <small>page header description goes here...</small> -->
	</div>

	<div class="mb-sm-4 mb-3 d-sm-flex" style="display: none !important;">
		<div class="mt-sm-0 mt-2"><a href="#" class="text-body text-decoration-none"><i class="fa fa-download fa-fw me-1 text-muted"></i> Export</a></div>
		<div class="ms-sm-4 mt-sm-0 mt-2"><a href="#" class="text-body text-decoration-none"><i class="fa fa-upload fa-fw me-1 text-muted"></i> Import</a></div>
		<div class="ms-sm-4 mt-sm-0 mt-2 dropdown-toggle">
			<a href="#" data-bs-toggle="dropdown" class="text-body text-decoration-none">More Actions</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="#">Action</a>
				<a class="dropdown-item" href="#">Another action</a>
				<a class="dropdown-item" href="#">Something else here</a>
				<div role="separator" class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">Separated link</a>
			</div>
		</div>
	</div>


	<!-- BEGIN #datatable -->
	<div id="datatable" class="mb-5">
		<div class="card">
			<div class="tab-content p-4">
				<div class="tab-pane fade show active" id="allTab">
					<!-- BEGIN input-group -->
					<div class="input-group mb-4">
						<button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter products &nbsp;</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
							<div role="separator" class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Separated link</a>
						</div>
						<div class="flex-fill position-relative z-1">
							<div class="input-group">
								<div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0" style="z-index: 1020;">
									<i class="fa fa-search opacity-5"></i>
								</div>
								<input type="text" class="form-control ps-35px search" placeholder="Search">
							</div>
						</div>
					</div>
					<!-- END input-group -->
					
					<!-- BEGIN table -->
					<input type="hidden" class="inv_in_id" value="<?= $inv_in_id ?>">
					<div class="table-responsive">
						<table id="inv_detail" class="table text-nowrap w-100">
							<thead class="w-100">
								<tr>
									<th>Location</th>
									<th>Qty</th>
									<th>Purchase Total Price</th>
									<th>Sale Unit Cost</th>
									<th>Sale Unit Pice</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
						
							</tbody>
						</table>
					</div>
					<!-- END table -->
				</div>
			</div>
		</div>
	</div>
	<!-- END #datatable -->
</div>
<?php include(APPPATH . 'Views/modals/conversion-modal.php') ?>