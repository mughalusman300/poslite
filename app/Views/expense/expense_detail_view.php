
<!-- BEGIN #content -->

<div id="content" class="app-content">
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
		<li class="breadcrumb-item active">STARTER PAGE</li>
	</ul>
	
	<h1 class="page-header d-flex justify-content-between">
		Expense Detail View
	</h1>


	<!-- BEGIN #datatable -->
	<div id="datatable" class="mb-5">
		<!-- <h4>Categories</h4> -->

		<div class="card">
			<div class="card-header bg-none fw-bold">
				<div class="row">
					<div class="col-md-2">	
						<label for="month_year" class="form-label">Expense Month</label>
						<input type="text" readonly="" class="form-control validate-input month_year" id="month_year" name="month_year" value="<?= $month_year ?>">
					</div>
				</div>

			</div>
			<div class="card-body">
				<?php 
				$sr = 0;
				foreach ($expense as $row): 
					$sr++;
					?>
					<div class="parent-row">
						<div class="row main-row mb-3 main-first-row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">						
										<label for="Date" class="form-label <?= ($sr == 1)  ? '': 'd-none' ?>">Date</label>
										<input type="text" readonly="" class="form-control validate-input date" value="<?= date('d-m-Y',strtotime($row->date)) ?>" id="date" name="date[]" >
									</div>

									<div class="col-md-2">
										<label for="expense_header" class="form-label <?= ($sr == 1)  ? '': 'd-none' ?>">Expense header</label>
										<select name="expense_header_id[]" id="expense_header" class="form-control validate-input select expense_header" disabled="">
											<option value="">Select</option>
											<?php foreach ($headers as $header):?>
												<option value="<?= $header->id?>" 
													<?= ($header->id == $row->expense_header_id) ? 'selected': ''?>
													><?= $header->name?></option>
											<?php endforeach;?>
										</select>
									</div>

									<div class="col-md-2">
										<label for="party" class="form-label <?= ($sr == 1)  ? '': 'd-none' ?>">Party</label>
										<select name="party_id[]" id="party" class="form-control validate-input select party" disabled="">
											<option value="">Select</option>
											<?php foreach ($parties as $party):?>
												<option value="<?= $party->id?>"
													<?= ($party->id == $row->party_id) ? 'selected': ''?>
													><?= $party->name?></option>
											<?php endforeach;?>
										</select>
									</div>

									<div class="col-md-2">
										<label for="payment_mode" class="form-label <?= ($sr == 1)  ? '': 'd-none' ?>">Payment Mode</label>
										<select name="payment_mode_id[]" id="payment_mode" class="form-control validate-input select payment_mode" disabled="">
											<option value="">Select</option>
											<?php foreach ($modes as $mode):?>
												<option value="<?= $mode->id?>"
													<?= ($mode->id == $row->payment_mode_id) ? 'selected': ''?>
													><?= $mode->name.'/'.$mode->payment_type.'/'.$mode->payment_mode_desc?></option>
											<?php endforeach;?>
										</select>
									</div>

									<div class="col-md-1">
										<label for="amount" class="form-label <?= ($sr == 1)  ? '': 'd-none' ?>">Amount</label>
										<input type="text" readonly="" class="form-control validate-input amount twodecimel" name="amount[]" id="amount" value="<?= $row->amount ?>" >
									</div>

									<div class="col-md-3">						
										<label for="narration" class="form-label <?= ($sr == 1)  ? '': 'd-none' ?>">Expense Narration</label>
										<input type="text" readonly="" class="form-control narration"  id="narration" name="narration[]" value="<?= $row->narration ?>">
									</div>

								</div>
							</div>

						</div>
					</div>
					<?php if($row->is_approved == 'y'):?>
						<div class="row" style="display: flex; justify-content: center;">
							<div style="display: flex; justify-content: end;">
								<b class="me-1" style="font-weight: 700">Status: </b> <span class="me-1" style="color: green">Approved</span> 
								|<b class="ms-1 me-1" style="font-weight: 700">Approved By: </b> <?= $row->approved_by_user ?> 
								|<b class="ms-1 me-1" style="font-weight: 700">Approved Date: </b> <?= date('d-m-Y h:i A',strtotime($row->approved_date)) ?> 
							</div>
						</div>
					<?php elseif($row->is_approved == 'n'):?>
						<div class="row" style="display: flex; justify-content: center;">
							<div style="display: flex; justify-content: end;">
								<b class="me-1" style="font-weight: 700">Status: </b>  <span class="me-1" style="color: red">Rejected</span>  
								|<b class="ms-1 me-1" style="font-weight: 700">Rejected By: </b> <?= $row->approved_by_user ?> 
								|<b class="ms-1 me-1" style="font-weight: 700">Rejected Date: </b> <?= date('d-m-Y h:i A',strtotime($row->approved_date)) ?> 
							</div>
						</div>
					<?php else:?>
					<?php endif;?>

					<hr>
				<?php endforeach;?>

				<div class="col-md-12 mb-3">
					<label for="desc" class="form-label">Description</label>
					<textarea readonly="" 
					type="textarea" name="desc" class="form-control desc"  placeholder="Description" id="desc" rows="5"><?= $desc ?></textarea>
				</div>

			</div>

			<div class="card-footer bg-none fw-bold">
				<div class="row">
					<div class="col-md-12" style="display: flex;justify-content: end">	
						<a  href ="<?= URL?>/expense" type="button" class="btn btn-outline-theme me-2 approve_all">Go Back</a>
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