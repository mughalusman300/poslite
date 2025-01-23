
<!-- BEGIN #content -->
<?php 
$this->db = \Config\Database::connect(); 
?>
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
		Lock Transaction 
	</h1>


	<!-- BEGIN #datatable -->
	<div id="datatable" class="mb-5">
		<!-- <h4>Categories</h4> -->
		<form id="add_payable_form" action="<?=URL?>/payable/pay/<?= $payable_id ?>" method="POST" enctype="multipart/form-data" class="product-form">
			<div class="card">
				<div class="card-header bg-none">
					<div class="" style="text-align: center"> <b>Payable Amount Detail</b> </div><hr>
					<table id="expense" class="table table-bordered text-nowrap w-100 mt-2">
					    <thead>
					        <tr>
					            <th >Account Name</th>
					            <th>Amount</th>
					            <th>Added By</th>
					            <th>Added Date</th>
					            <th style="width: 30%">Description</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<tr>
					    		<td><?= $payable->account_name ?></td>
					    		<td>
					    			<?= number_format($payable->amount, 2) ?>
					    			<input type="hidden" class="total_amount" name="total_amount" value="<?= $payable->amount ?>">
					    		</td>
					    		<td><?= $payable->added_by ?></td>
					    		<td><?= date('d-m-Y',strtotime($payable->created_at)) ?></td>
					    		<td><?= $payable->payable_desc ?></td>
					    	</tr>
					    </tbody>
					</table>

					<table id="expense" class="table table-bordered text-nowrap w-100 mt-2">
					    <tbody>
					    	<tr>
		    		    		<td class="fw-bold"> Approved Ammount</td>
		    					<td class="approved-amount fw-bold" style="color: green"> </td>

		    		    		<td class="fw-bold"> Pending Approval</td>
		    					<td class="pending-approval fw-bold" style="color: brown"> </td>

		    					<td class="fw-bold"> Rejected Ammount</td>
		    					<td class="rejected-amount fw-bold" style="color: red"> </td>
		    					<td class="fw-bold"> Pending Ammount</td>
		    					<td class="pending-amount fw-bold" style="color: blue"></td>
					    	</tr>
					    </tbody>
					</table>

				</div>
				<div class="card-body">
					<div class="" style="text-align: center"> <b>Payment Detail</b> </div><hr>
					<table id="payment_details" class="table table-bordered text-nowrap w-100 mt-2">
					    <thead>
					        <tr>
					            <th>Date</th>
					            <th>Payment Mode</th>
					            <th>Description</th>
					            <th>Amount</th>
					            <?php if(in_array('alter_payable_lock', $_SESSION['permissions']) ) { ?>
					            	<th class="text-center">Action</th>
					            <?php } ?>
					        </tr>
					    </thead>
					    <tbody>
						<?php foreach ($paid as $row) { ?>

						        <tr>
						            <td>
						                <?= date('d-m-Y', strtotime($row->payment_date)) ?>
						            </td>
						            <td>
						                <?php foreach ($modes as $mode): ?>
						                    <?php if ($row->payment_mode_id == $mode->id): ?>
						                        <?= $mode->name . ' | ' . $mode->payment_type . ' | ' . $mode->payment_mode_desc ?>
						                    <?php endif; ?>
						                <?php endforeach; ?>
						            </td>
						            <td>
						                <?= htmlspecialchars($row->payable_detail_desc) ?> <!-- Escapes special characters for security -->
						            </td>
						            <td>
						                <?= number_format($row->payable_detail_amount, 2) ?> <!-- Formats amount with two decimal places -->
						                <input type="hidden" 
						                	class="amount" 
						                	data-is_lock="<?= $row->is_lock?>" 
						                	data-is_rejected="<?= $row->is_rejected?>" 
						                	value="<?= $row->payable_detail_amount ?>"
						                >
						            </td>
						            <?php if(in_array('alter_payable_lock', $_SESSION['permissions']) ) { ?>
							            <td class="text-center action-cell">
							                <div>
							                    <?php if ($row->is_lock || $row->is_rejected): 
							                        $lock_reject_by = $this->db->table('saimtech_users')->select('name')->where('id', $row->lock_reject_by)->get()->getRow()->name; 
							                    ?>
							                        <?php if ($row->is_lock): ?>
							                            <span class="fw-bold">Locked (<?= htmlspecialchars($lock_reject_by) ?>)</span>
							                            <!-- | <button type="button" data-payable_detail_id="<?= $row->payable_detail_id ?>" class="btn btn-sm btn-outline-theme revert">
							                            	<i class="fas fa-undo"></i> Revert
							                            </button> -->

							                            <br><i class="fas fa-undo revert" 
							                            style="color: #1f6bff; cursor: pointer;" 
							                            data-payable_detail_id="<?= $row->payable_detail_id ?>"
							                            data-bs-toggle="tooltip" data-bs-placement="top" title="Undo last action"></i>
							                        <?php elseif ($row->is_rejected): ?>
							                            <span class="fw-bold">Rejected (<?= htmlspecialchars($lock_reject_by) ?>)</span>
							                            <!-- | <button type="button" data-payable_detail_id="<?= $row->payable_detail_id ?>" class="btn btn-sm btn-outline-theme me-2 revert mt-2"><i class="fas fa-undo"></i> Revert</button> -->
							                            <br><i class="fas fa-undo revert" 
							                            style="color: #1f6bff; cursor: pointer;" 
							                            data-payable_detail_id="<?= $row->payable_detail_id ?>"
							                            data-bs-toggle="tooltip" data-bs-placement="top" title="Undo last action"></i>

							                        <?php endif; ?>
							                    <?php else: ?>
							                        <button type="button" data-payable_detail_id="<?= $row->payable_detail_id ?>" data-type="lock" class="btn btn-sm btn-outline-theme me-2 update-status"> <i class="fas fa-lock"></i> Lock</button>
							                        <button type="button" data-payable_detail_id="<?= $row->payable_detail_id ?>" data-type="reject" class="btn btn-sm btn-outline-theme me-2 update-status"> <i class="fas fa-times"></i> Reject</button>
							                    <?php endif; ?>
							                </div>
							            </td>
							        <?php } ?>
						        </tr>

						<?php } ?>
					    </tbody>
					</table>

				</div>

				<div class="card-footer bg-none fw-bold">
					<div class="row">
						<div class="col-md-12" style="display: flex;justify-content: end">	
							<a type="button" href="<?= URL?>/payable" class="btn btn-outline-theme me-2 submit"> <i class="fas fa-fw me-2 fa-arrow-left"></i>Go Back</a>
							<button type="button" data-payable_id="<?= $payable_id ?>" class="btn btn-outline-theme me-2 complete" style="display: none;"> <i class="far fa-fw me-2 fa-check-square"></i>Complete</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- END #datatable -->
</div>