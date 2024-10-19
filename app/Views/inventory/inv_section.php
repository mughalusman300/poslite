<?php
use App\Models\Commonmodel;
$this->Commonmodel = new Commonmodel();
?>
	
	<?php if ($product->v1 != '' || $product->v2 != '' || $product->v3 != ''):?>
		<div class="row mb-3">
			<?php if($product->v1 != '') {
				$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v1)), 'saimtech_variant');
				$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
				// dd($variant);
			?>
				<div class="col-4">
					<label class="form-label"><?= $product->v1 ?> <span class="text-danger">*</span></label><br>
					<select name="v1" id="v1" class="form-control validate-input select validate-input select select2 v1">
						<option value="">Select</option>
						<?php if($variant_detail):?>
							<?php foreach($variant_detail as $row):?>
								<option value="<?= $row->variant_detail_name ?>"><?= $row->variant_detail_name ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
				</div>
			<?php } ?>

			<?php if($product->v2 != '') {
				$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v2)), 'saimtech_variant');
				$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
				// dd($variant);
			?>
				<div class="col-4">
					<label class="form-label"><?= $product->v2 ?> <span class="text-danger">*</span></label><br>
					<select name="v2" id="v2" class="form-control validate-input select select2 v2">
						<option value="">Select</option>
						<?php if($variant_detail):?>
							<?php foreach($variant_detail as $row):?>
								<option value="<?= $row->variant_detail_name ?>"><?= $row->variant_detail_name ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
				</div>
			<?php } ?>

			<?php if($product->v3 != '') {
				$variant = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('variant_name' => $product->v3)), 'saimtech_variant');
				$variant_detail = $this->Commonmodel->getRows(array('conditions' => array('variant_id' => $variant->variant_id)), 'saimtech_variant_detail');
				// dd($variant);
			?>
				<div class="col-4">
					<label class="form-label"><?= $product->v3 ?> <span class="text-danger">*</span></label><br>
					<select name="v3" id="v3" class="form-control validate-input select select2 v3">
						<option value="">Select</option>
						<?php if($variant_detail):?>
							<?php foreach($variant_detail as $row):?>
								<option value="<?= $row->variant_detail_name ?>"><?= $row->variant_detail_name ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
				</div>
			<?php } ?>

		</div>
	<?php endif;?>

	<?php if ($purchase_conversion || $inv_conversion || 1 == 1):?>
		<?php  

			if ($purchase_conversion) {
				$big_unit = $purchase_conversion->big_unit;
				$small_unit_qty = $purchase_conversion->small_unit_qty;
				if ($product->purch_unit == $big_unit) {
					$p_to_i = '*';
				} else {
					$p_to_i = '/';
				}
			} else {
				$p_to_i = '*';
				$small_unit_qty = 1;
			}

			if ($inv_conversion) {
				$inv_big_unit = $inv_conversion->big_unit;
				$inv_small_unit_qty = $inv_conversion->small_unit_qty;
				if ($product->inv_unit == $inv_big_unit) {
					$i_to_s = '*';
				} else {
					$i_to_s = '/';
				}
			} else {
				$i_to_s = '*';
				$inv_small_unit_qty = 1;
			}


		?>
		<div class="row mb-3">
			<input type="hidden" id= 'p_to_i' value="<?= $p_to_i ?>">
			<input type="hidden" id= 'small_unit_qty' value="<?= $small_unit_qty ?>">
			<input type="hidden" id= 'i_to_s' value="<?= $i_to_s ?>">
			<input type="hidden" id= 'inv_small_unit_qty' value="<?= $inv_small_unit_qty ?>">
			
			<div class="col-4">
				<label class="form-label">Purchase Qty (<?= $product->purch_unit ?>) <span class="text-danger">*</span></label><br>
				<input type="text" class="form-control validate-input number purch_qty" name="purch_qty" placeholder="Purchase Qty">
			</div>

			<div class="col-4">
				<label class="form-label">Inventory Qty (<?= $product->inv_unit ?>) <span class="text-danger"></span></label><br>
				<input type="text" readonly class="form-control number inv_qty" name="inv_qty" placeholder="Inventory Qty">
			</div>

			<div class="col-4">
				<label class="form-label">Sale Qty (<?= $product->sale_unit ?>) <span class="text-danger"></span></label><br>
				<input type="text" readonly class="form-control number sale_qty" name="sale_qty" placeholder="Sale Qty">
			</div>

		</div>
	<?php endif;?>

	<div class="row mb-3">
		
		<div class="col-4">
			<label class="form-label">Purchase Total Price<span class="text-danger">*</span></label><br>
			<input type="text" class="form-control validate-input number purch_total_price" name="purch_total_price" placeholder="Purchase Total Price">
		</div>

		<div class="col-4">
			<label class="form-label">Unit Price cost (sale qty) </label><br>
			<input type="text" readonly class="form-control number sale_unit_cost" name="sale_unit_cost" placeholder="Unit Price">
		</div>

		<div class="col-4">
			<label class="form-label">Sale Unit Price <span class="text-danger">*</span></label><br>
			<input type="text" class="form-control validate-input number sale_unit_price" name="sale_unit_price" placeholder="Sale Unit Price">
		</div>

	</div>
	<div class="row mb-3 barcode-div">
		<div class="col-4">
			<label class="form-label">Barcode<span class="text-danger"></span></label><br>
			<input type="text" class="form-control dashspecialvalidation barcode" name="barcode[]" placeholder="Scan barcode">
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-12 barcode-footer text-end">
			<button type="button" class="btn btn-default add-more-barcode mt-1" style="width: 200px;">Add More Barcode</button>
		</div>

		<div class="col-12">
			<label class="form-label">Description <span class="text-danger"></span></label><br>
			<textarea type="textarea" class="form-control desc descriptionvalidation"  name="desc" placeholder="Add Description"  rows="4"></textarea>
		</div>

	</div>
	<div class="row mb-3">
		<div class="col-12 text-end">
			<button type="button" class="btn btn-outline-theme save" style="width: 200px;">Save</button>
		</div>
	</div>