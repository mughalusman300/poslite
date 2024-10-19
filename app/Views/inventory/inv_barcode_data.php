<?php 
use App\Models\Commonmodel; 
$this->Commonmodel = new Commonmodel();
?>
<div class="row">

		<div class="table-responsive">
			<table id="inventory" class="table text-nowrap w-100">
				<thead class="w-100">
					<tr>
						<th>Barcode</th>
						<th>Qty</th>
						<th>Action</th>
					</tr>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<?php 
								$barcode = $item->barcode;
								$full_barcode = $barcode;

								$this->Commonmodel->generateProductBarcode($barcode, 'code128', false);
							?>

							<img style="max-width: 185px; max-height: 70px;" src="<?= URL?>/pdf/<?= $barcode?>.png" alt="barcode">
						</td>
						<td>
							<input type="hidden" class="barcode" value="<?=$barcode ?>">
							<input type="number" class="form-control validate-input barcode_qty number w-100px" min="1" max="100" placeholder="1" value="<?= $qty ?>" required="">
						</td>
						<td>
							<button type="button" class="btn btn-theme mb-1 print">Print</button>
						</td>
					</tr>
			
				</tbody>
			</table>
		</div>
</div>
