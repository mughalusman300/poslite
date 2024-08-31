
<!-- BEGIN #content -->

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
		<div class="card">
			<div class="card-header bg-none fw-bold">
				<div class="row">
					<div class="col-md-2">	
						<label for="month_year" class="form-label">Expense Month</label> <span class="color-red">*</span>
						<input type="month" class="form-control validate-input month_year" id="month_year" name="month_year" min="2018-03" value="" />
					</div>
				</div>

			</div>
			<div class="card-body">
				
				<div class="row main-row mb-3 main-first-row">
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-2">						
								<label for="Date" class="form-label">Date</label> <span class="color-red">*</span>
								<input type="date" class="form-control validate-input Date" placeholder="Date" id="Date" value="" required="">
							</div>

							<div class="col-md-2">
								<label for="expense_header" class="form-label">Expense header</label> <span class="color-red">*</span>
								<select name="expense_header" id="expense_header" class="form-control validate-input select expense_header">
									<option value="">Select</option>
									<?php foreach ($headers as $row):?>
										<option value="<?= $row->id?>"><?= $row->name?></option>
									<?php endforeach;?>
								</select>
							</div>

							<div class="col-md-2">						
								<label for="expense_narration" class="form-label">Expense Narration</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input expense_narration" placeholder="add Narration" id="expense_narration" value="" required="">
							</div>

							<div class="col-md-2">
								<label for="party" class="form-label">Party</label> <span class="color-red">*</span>
								<select name="party" id="party" class="form-control validate-input select party">
									<option value="">Select</option>
									<?php foreach ($parties as $row):?>
										<option value="<?= $row->id?>"><?= $row->name?></option>
									<?php endforeach;?>
								</select>
							</div>

							<div class="col-md-3">
								<label for="payment_mode" class="form-label">Payment Mode</label> <span class="color-red">*</span>
								<select name="payment_mode" id="payment_mode" class="form-control validate-input select payment_mode">
									<option value="">Select</option>
									<?php foreach ($modes as $row):?>
										<option value="<?= $row->id?>"><?= $row->name.'/'.$row->payment_type.'/'.$row->payment_mode_desc?></option>
									<?php endforeach;?>
								</select>
							</div>
							<div class="col-md-1">
								<label for="amount" class="form-label">Amount</label> <span class="color-red">*</span>
								<input type="text" class="form-control validate-input amount twodecimel" placeholder="Amount" id="amount" value="" required="">
							</div>
						</div>
					</div>
					<div class="col-md-1">
						<label for="Date" class="form-label" style="visibility: hidden">Date</label>
						<button type="button" class="btn btn-outline-theme me-2 add-more" style="width: 100px;">Add more</button>
					</div>

				</div>

			</div>

			<div class="card-footer bg-none fw-bold">
				<div class="row">
					<div class="col-md-12" style="display: flex;justify-content: end">	
						<button type="button" class="btn btn-outline-theme me-2 add-more">Submit</button>
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