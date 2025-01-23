
<!-- BEGIN #content -->
<?php 
$this->db = \Config\Database::connect(); 
?>
<style type="text/css">
	.datepicker.datepicker-dropdown {
		z-index: 1200 !important;
	}
	.action-cell {
		width: 150px !important;
	}
</style>

<div id="content" class="app-content">
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
		<li class="breadcrumb-item active">STARTER PAGE</li>
	</ul>
	
	<h1 class="page-header d-flex justify-content-between">
		<?= ($type == 'pay') ? 'Add' : ''?> Receivable 
	</h1>


	<!-- BEGIN #datatable -->
	<div id="datatable" class="mb-5">
		<!-- <h4>Categories</h4> -->
		<div class="card">
			<div class="card-header bg-none">
				<div class="" style="text-align: center"> <b>Receivable Amount Detail</b> </div><hr>
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
				    		<td><?= $receivable->account_name ?></td>
				    		<td><?= number_format($receivable->amount, 2) ?>
				    			<input type="hidden" class="total_amount" name="total_amount" value="<?= $receivable->amount ?>">
				    			<input type="hidden" class="pending_amount" name="pending_amount" value="<?= $pending_amount ?>">
				    		</td>
				    		<td><?= $receivable->added_by ?></td>
				    		<td><?= date('d-m-Y',strtotime($receivable->created_at)) ?></td>
				    		<td><?= $receivable->receivable_desc ?></td>
				    	</tr>
				    </tbody>
				</table>

				<?php if($paid || $type == 'view') { ?>
					<div class="" style="text-align: center"> <b><?= ($type == 'pay') ? 'Previous Transaction Detail' : 'Transaction Detail'?></b> </div>
					<table id="previous_details" class="table table-bordered text-nowrap w-100 mt-2">
					    <thead>
					        <tr>
					            <th>Date</th>
					            <th>Payment Mode</th>
					            <th>Description</th>
					            <th>Amount</th>
					            <th class="text-center">Status</th>
					            <?php if($type != 'view' && in_array('alter_receivable_pay', $_SESSION['permissions']) ) { ?>
					            	<th class="text-center action-cell">Action</th>
					            <?php }?>
					        </tr>
					    </thead>
					    <tbody class="previous_details_tbody">
					    	<?php if ($paid) { ?>
								<?php foreach ($paid as $row) { ?>

								        <tr class="previous_detail_row">
								            <td>
								            	<input type="hidden" class="receivable_detail_id" value="<?= $row->receivable_detail_id ?>" >
								            	<div class="show payment_date_text">
								                	<?= date('d-m-Y', strtotime($row->payment_date)) ?>
								                </div>
							                	<div class="update" style="display: none">
							                    	<input type="text" readonly="" class="form-control validate-input payment_date" placeholder="dd-mm-yyyy" id="payment_date" value="<?= date('d-m-Y', strtotime($row->payment_date)) ?>">
							                    </div>
								            </td>
								            <td>
								            	<div class="show payment_mode_id_text">
									                <?php foreach ($modes as $mode): ?>
									                    <?php if ($row->payment_mode_id == $mode->id): ?>
									                        <?= $mode->name . ' | ' . $mode->payment_type . ' | ' . $mode->payment_mode_desc ?>
									                    <?php endif; ?>
									                <?php endforeach; ?>
									            </div>
								                <div class="update" style="display: none">
								                	<select  id="payment_mode_id" class="form-control validate-input select payment_mode_id" >
								                		<option value="">Select</option>
								                		<?php foreach ($modes as $mode):?>
								                			<option value="<?= $mode->id?>"
								                				<?= ($row->payment_mode_id == $mode->id) ? 'selected' : '' ?>
								                				><?= $mode->name.' | '.$mode->payment_type.' | '.$mode->payment_mode_desc?></option>
								                		<?php endforeach;?>
								                	</select>
								                </div>
								            </td>
								            <td>
								            	<div class="show receivable_detail_desc_text">
								                	<?= htmlspecialchars($row->receivable_detail_desc) ?>
								                </div>
								                <div class="update" style="display: none">
								                	<textarea type="textarea" class="form-control receivable_detail_desc"  placeholder="Description" id="receivable_detail_desc" rows="2"><?= $row->receivable_detail_desc ?></textarea>
								                </div>
								            </td>
								            <td class="text-center">
								            	<div class="show receivable_detail_amount_text">
								                	<?= number_format($row->receivable_detail_amount, 2) ?>
									            </div>
								                <input type="hidden" 
								                	class="amount" 
								                	data-is_lock="<?= $row->is_lock?>" 
								                	data-is_rejected="<?= $row->is_rejected?>" 
								                	value="<?= $row->receivable_detail_amount ?>"
								                >
									            <div class="update" style="display: none; width: 100px;">
									            	<input type="text" data-old_val= "<?= $row->receivable_detail_amount ?>" class="form-control validate-input receivable_detail_amount twodecimel" placeholder="0.00" id="receivable_detail_amount" value="<?= $row->receivable_detail_amount ?>" >
									            </div>
								            </td>
								            <td class="text-center">
								                <div>
								                    <?php if ($row->is_lock || $row->is_rejected): 
								                        $lock_reject_by = $this->db->table('saimtech_users')->select('name')->where('id', $row->lock_reject_by)->get()->getRow()->name; 
								                    ?>
								                        <?php if ($row->is_lock): ?>
								                        	<input type="hidden" class="status" value="locked">
								                            <span class="fw-bold">Locked (<?= htmlspecialchars($lock_reject_by) ?>)</span>
								                        <?php elseif ($row->is_rejected): ?>
								                        	<input type="hidden" class="status" value="rejected">
								                            <span class="fw-bold">Rejected (<?= htmlspecialchars($lock_reject_by) ?>)</span>
								                        <?php endif; ?>
								                    <?php else: ?>
								                    	<input type="hidden" class="status" value="pending">
								                        Pending Approval
								                        <br>
								                        <div style="color: blue; text-decoration: underline; cursor: pointer; display: none;"
								                        	class="edit" 
								                        >Edit</div> 
								                    <?php endif; ?>
								                </div>
								            </td>
								            <?php if($type != 'view' && in_array('alter_receivable_pay', $_SESSION['permissions']) ) { ?>
									            <td class="text-center">
									                <?php if (!$row->is_lock && !$row->is_rejected): ?>
									                	<button class="btn btn-sm btn-outline-theme edit"
			                	                            data-receivable_detail_id="<?= $row->receivable_detail_id ?>"
			                	                            ><i class="fas fa-edit"></i> <span class="edit_span">Edit</span></button>
									                	<button class="btn ms-2 btn-sm btn-outline-danger delete"
				                	                        data-receivable_detail_id="<?= $row->receivable_detail_id ?>"
				                	                        ><i class="fas fa-trash-alt"></i> Delete</button>
									                <?php endif; ?>
									            </td>
								        	<?php } ?>
								        </tr>

								<?php } ?>
							<?php } ?>
							<?php if(!$paid && $type == 'view') { ?>
								<tr>
									<td colspan="6" class="text-center">No transactions have been added yet!</td>
								</tr>
							<?php } ?>
					    </tbody>
					</table>

					<table id="expense" class="table table-bordered text-nowrap w-100 mt-2">
					    <tbody>
					    	<tr>
					    		<td class="fw-bold"> Approved Ammount</td>
								<td class="approved-amount fw-bold" style="color: green"> </td>

					    		<td class="fw-bold"> Pending Approval</td>
								<td class="pending-approval fw-bold" style="color: brown"> </td>

								<td class="fw-bold"> Rejected Amount</td>
								<td class="rejected-amount fw-bold" style="color: red"> </td>
								<td class="fw-bold"> Pending Amount</td>
								<td class="pending-amount fw-bold" style="color: blue"></td>
					    	</tr>
					    </tbody>
					</table>
				<?php } ?>

			</div>
			<?php if($type == 'pay' && in_array('alter_receivable_pay', $_SESSION['permissions'])) { ?>
				<form id="add_receivable_form" action="<?=URL?>/receivable/pay/<?= $receivable_id ?>" method="POST" enctype="multipart/form-data" class="product-form">
					<div class="card-body">
						<div class="" style="text-align: center"> <b>Add Payment</b> </div><hr>
						<div class="parent-row">
							<div class="row main-row mb-3 main-first-row">
								
								<div class="col-md-3">						
									<label for="payment_date" class="form-label">Date</label> <span class="color-red">*</span>
									<input type="text" readonly="" class="form-control validate-input payment_date" placeholder="dd-mm-yyyy" id="payment_date" name="payment_date[]" >
								</div>


								<div class="col-md-3">
									<label for="payment_mode" class="form-label">Payment Mode</label> <span class="color-red">*</span>
									<select name="payment_mode_id[]" id="payment_mode" class="form-control validate-input select payment_mode" >
										<option value="">Select</option>
										<?php foreach ($modes as $row):?>
											<option value="<?= $row->id?>"><?= $row->name.' | '.$row->payment_type.' | '.$row->payment_mode_desc?></option>
										<?php endforeach;?>
									</select>
								</div>

								<div class="col-md-2">
									<label for="receivable_detail_amount" class="form-label">Amount</label> <span class="color-red">*</span>
									<input type="text" class="form-control validate-input receivable_detail_amount twodecimel" placeholder="0.00" name="receivable_detail_amount[]" id="receivable_detail_amount" value="" >
								</div>

								<div class="col-md-3">						
									<label for="receivable_detail_desc" class="form-label">Description</label>
									<textarea type="textarea" name="receivable_detail_desc[]" class="form-control receivable_detail_desc"  placeholder="Description" id="receivable_detail_desc" rows="2" value=""></textarea>
								</div>
								<div class="col-md-1">
									<label for="Date" class="form-label" style="visibility: hidden">Date</label>
									<button type="button" class="btn btn-outline-theme me-2 add-more" style="width: 100px;">Add more</button>
								</div>

							</div>
						</div>

					</div>

					<div class="card-footer bg-none fw-bold">
						<div class="row">
							<div class="col-md-12" style="display: flex;justify-content: end">	
								<a type="button" href="<?= URL?>/receivable" class="btn btn-outline-theme me-2"> <i class="fas fa-fw fa-arrow-left"> </i>Go Back</a>
								<button type="submit" class="btn btn-outline-theme me-2 submit">Submit</button>
							</div>
						</div>
					</div>
				</form>
			<?php }?>
		</div>

		<div class="extra-row" style="display: none;">
			<div class="row main-row mb-3">
				<div class="col-md-3">						
					<input type="text" readonly="" class="form-control validate-input payment_date" placeholder="dd-mm-yyyy" id="payment_date" name="payment_date[]" >
				</div>


				<div class="col-md-3">
					<select name="payment_mode_id[]" id="payment_mode" class="form-control validate-input select payment_mode" >
						<option value="">Select</option>
						<?php foreach ($modes as $row):?>
							<option value="<?= $row->id?>"><?= $row->name.' | '.$row->payment_type.' | '.$row->payment_mode_desc?></option>
						<?php endforeach;?>
					</select>
				</div>

				<div class="col-md-2">
					<input type="text" class="form-control validate-input receivable_detail_amount twodecimel" placeholder="0.00" name="receivable_detail_amount[]" id="receivable_detail_amount" value="" >
				</div>

				<div class="col-md-3">						
					<textarea type="textarea" name="receivable_detail_desc[]" class="form-control receivable_detail_desc"  placeholder="Description" id="receivable_detail_desc" rows="2" value=""></textarea>
				</div>
				<div class="col-md-1">
					<button type="button" class="btn btn-outline-theme me-2 remove-row" style="width: 100px;">Remove</button>
				</div>

			</div>
		</div>
	</div>
	<!-- END #datatable -->
</div>