
<!-- BEGIN #content -->
<div id="content" class="app-content">
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
		<li class="breadcrumb-item active">STARTER PAGE</li>
	</ul>
	
	<h1 class="page-header d-flex justify-content-between">
		Items 
		<?php if (in_array('alter_item', $_SESSION['permissions'])): ?>
			<button type="button" class="btn btn-outline-theme me-2 add-item">Add Item</button>
		<?php endif ;?>
		<!-- Items <small>page header description goes here...</small> -->
	</h1>


	<!-- BEGIN #datatable -->
	<div id="datatable" class="mb-5">
		<!-- <h4>Categories</h4> -->
		<div class="card">
			<div class="card-body">
				<table id="category" class="table text-nowrap w-100">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Category</th>
							<th>Available Qty</th>
							<th>Purchase Price</th>
							<th>Sale Price</th>
							<th>Discount</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				
					</tbody>
				</table>
			</div>
			<!-- <div class="hljs-container rounded-bottom">
				<pre><code class="xml" data-url="assets/data/table-plugins/code-1.json"></code></pre>
			</div> -->
		</div>
	</div>
	<!-- END #datatable -->
</div>
<!-- END #content -->
<?php include(APPPATH . 'Views/modals/item-modal.php') ?>
<?php include(APPPATH . 'Views/modals/item-barcode-modal.php') ?>