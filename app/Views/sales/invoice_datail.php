
<!-- BEGIN #content -->
    <form id="return_form" name="return_form" action="<?=URL?>/sales/return" method="POST" class="return-form">
        <table id="detail_table" class="table text-nowrap w-100">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Discount</th>
                    <th>Net</th>
                    <th>Return Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($invoice_detail)) {?>
                        <?php foreach ($invoice_detail as $detail) { 
                            if($detail->quantity > 0) {
                            ?>
                            <tr>
                                <td><?= $detail->item_name ?></td>
                                <td><?= $detail->price ?></td>
                                <td>
                                    <input type="hidden" name="invoice_code" class="invoice_code form-control" value="<?= $detail->invoice_code ?>">

                                    <input type="hidden" name="qty[]" class="qty form-control" value="<?= $detail->quantity ?>">
                                    <input type="hidden" name="sale_trans_id[]" class="sale_trans_id form-control" value="<?= $detail->sale_trans_id ?>">
                                    <?= $detail->quantity ?>
                                </td>
                                <td><?= $detail->discount ?></td>
                                <td><?= $detail->net_price ?></td>
                                <td>
                                    <input type="number" style="width: 80px;" name="return_qty[]" class="return_qty form-control validate-input">
                                </td>
                            </tr>
                        <?php } } ?>
                <?php }?>
            </tbody>
        </table>
    </form>