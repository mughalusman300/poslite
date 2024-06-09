
<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
        <li class="breadcrumb-item active">STARTER PAGE</li>
    </ul>
    
    <h1 class="page-header d-flex justify-content-between">
        Sale Report By Date Detail
        <!-- <button type="button" class="btn btn-outline-theme me-2 add-item">Add Item</button> -->
        <!-- Items <small>page header description goes here...</small> -->
    </h1>


    <!-- BEGIN #datatable -->
    <div id="datatable" class="mb-5">
        <!-- <h4>Categories</h4> -->
        <div class="card">
                
            <table id="category" class="table text-nowrap w-100 mt-4 mb-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice code</th>
                        <th>Item Name</th>
                        <th>Purchase Unit Price</th>
                        <th>Sale Unit Price</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Net</th>
                    </tr>
                </thead>
                <?php if(isset($report_data) && !empty($report_data)) { 
                        $i= 1;
                        $total_purch_price = $total_sale_price = $total_discount = $total_quantity = $total_net = $total_invoice_total = $total_price = 0;
                    ?>
                    <tbody>
                        <?php foreach ($report_data as $row) { ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td>
                                    <?= $row->invoice_code ?>
                                </td>
                                <td>
                                    <?= $row->item_name ?>        
                                </td>
                                <td>
                                    <?= $row->purch_price ?>
                                    <?php $total_purch_price += $row->purch_price; ?>          
                                </td>
                                <td>
                                    <?= $row->price ?>
                                    <?php $total_sale_price += $row->price; ?>          
                                </td>
                                <td>
                                    <?= $row->quantity ?>
                                    <?php $total_quantity += $row->quantity; ?>          
                                </td>
                                <td>
                                    <?= $row->discount ?>
                                    <?php $total_discount += $row->discount; ?>          
                                </td>
                                <td>
                                    <?= $row->discount + $row->net_price ?>
                                    <?php $total_price += $row->discount + $row->net_price; ?>          
                                </td>
                                <td>
                                    <?= $row->net_price ?>
                                    <?php $total_net += $row->net_price; ?>          
                                </td>
                            </tr>
                        <?php $i++; }?>
                            <tr>
                                <td colspan="4" ></td>
                                <td> <b>Grand Total </b></td>
                                <td> <b><?= $total_quantity ?></b></td>
                                <td> <b>PKR <?= $total_discount ?></b></td>
                                <td> <b>PKR <?= $total_price ?></b></td>
                                <td> <b>PKR <?= $total_net ?></b></td>
                            </tr>
                    </tbody>

                <?php } else {?>
                    <tbody>
                        <tr><td colspan="9" class="text-center">Data Not Found!</td></tr>
                    </tbody>
                <?php } ?>
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