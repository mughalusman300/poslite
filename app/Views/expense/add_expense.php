
<!-- BEGIN #content -->
<style type="text/css">
	.datepicker.datepicker-dropdown {
		z-index: 1200 !important;
	}
</style>

<div id="content" class="app-content">
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
		<li class="breadcrumb-item active">STARTER PAGE</li>
	</ul>
	
	<h1 class="page-header d-flex justify-content-between">
		Add Expense 
	</h1>


	<!-- BEGIN #datatable -->
	<div id="datatable" class="mb-5">
		<!-- <h4>Categories</h4> -->
		<form id="add_expense" action="<?=URL?>/expense/add_expense" method="POST" enctype="multipart/form-data" class="product-form">
			<div class="card">
				<div class="card-header bg-none fw-bold">
					<div class="row">
						<div class="col-md-2">	
							<label for="month_year" class="form-label">Expense Month</label> <span class="color-red">*</span>
							<input type="text" readonly="" class="form-control validate-input month_year" id="month_year" name="month_year" placeholder="mm-yyyy" min="2018-03"/>
						</div>
					</div>

				</div>
				<div class="card-body">
					<div class="parent-row">
						<div class="row main-row mb-3 main-first-row">
							<div class="col-md-11">
								<div class="row">
									<div class="col-md-2">						
										<label for="Date" class="form-label">Date</label> <span class="color-red">*</span>
										<input type="text" readonly="" class="form-control validate-input date" placeholder="dd-mm-yyyy" id="date" name="date[]" >
									</div>

									<div class="col-md-2">
										<label for="expense_header" class="form-label">Expense header</label> <span class="color-red">*</span>
										<select name="expense_header_id[]" id="expense_header" class="form-control validate-input select expense_header" >
											<option value="">Select</option>
											<?php foreach ($headers as $row):?>
												<option value="<?= $row->id?>"><?= $row->name?></option>
											<?php endforeach;?>
										</select>
									</div>

									<div class="col-md-2">
										<label for="party" class="form-label">Party</label> <span class="color-red">*</span>
										<select name="party_id[]" id="party" class="form-control validate-input select party" >
											<option value="">Select</option>
											<?php foreach ($parties as $row):?>
												<option value="<?= $row->id?>"><?= $row->name?></option>
											<?php endforeach;?>
										</select>
									</div>

									<div class="col-md-2">
										<label for="payment_mode" class="form-label">Payment Mode</label> <span class="color-red">*</span>
										<select name="payment_mode_id[]" id="payment_mode" class="form-control validate-input select payment_mode" >
											<option value="">Select</option>
											<?php foreach ($modes as $row):?>
												<option value="<?= $row->id?>"><?= $row->name.'/'.$row->payment_type.'/'.$row->payment_mode_desc?></option>
											<?php endforeach;?>
										</select>
									</div>

									<div class="col-md-1">
										<label for="amount" class="form-label">Amount</label> <span class="color-red">*</span>
										<input type="text" class="form-control validate-input amount twodecimel" placeholder="0.00" name="amount[]" id="amount" value="" >
									</div>

									<div class="col-md-3">						
										<label for="narration" class="form-label">Expense Narration</label>
										<input type="text" class="form-control narration" placeholder="add Narration" id="narration" name="narration[]" value="">
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
						<label for="desc" class="form-label">Description</label>
						<textarea type="textarea" name="desc" class="form-control desc"  placeholder="Description" id="desc" rows="5" value=""></textarea>
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

		<div class="extra-row" style="display: none;">
			<div class="row main-row mb-3">
				<div class="col-md-11">
					<div class="row">
						<div class="col-md-2">						
							<input type="text" readonly="" class="form-control validate-input date" placeholder="dd-mm-yyyy" id="Date" name="date[]" value="" >
						</div>

						<div class="col-md-2">
							<select name="expense_header_id[]" id="expense_header" class="form-control validate-input select expense_header" >
								<option value="">Select</option>
								<?php foreach ($headers as $row):?>
									<option value="<?= $row->id?>"><?= $row->name?></option>
								<?php endforeach;?>
							</select>
						</div>

						<div class="col-md-2">
							<select name="party_id[]" id="party" class="form-control validate-input select party" >
								<option value="">Select</option>
								<?php foreach ($parties as $row):?>
									<option value="<?= $row->id?>"><?= $row->name?></option>
								<?php endforeach;?>
							</select>
						</div>

						<div class="col-md-2">
							<select name="payment_mode_id[]" id="payment_mode" class="form-control validate-input select payment_mode" >
								<option value="">Select</option>
								<?php foreach ($modes as $row):?>
									<option value="<?= $row->id?>"><?= $row->name.'/'.$row->payment_type.'/'.$row->payment_mode_desc?></option>
								<?php endforeach;?>
							</select>
						</div>

						<div class="col-md-1">
							<input type="text" class="form-control validate-input amount twodecimel" placeholder="0.00" name="amount[]" id="amount" value="" >
						</div>

						<div class="col-md-3">						
							<input type="text" class="form-control narration" placeholder="add Narration" id="narration" name="narration[]" value="">
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