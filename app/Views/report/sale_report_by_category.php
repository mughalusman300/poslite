<?php 
use App\Models\Reportmodel;
$this->Reportmodel = new Reportmodel();
?>
<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
        <li class="breadcrumb-item active">STARTER PAGE</li>
    </ul>
    
    <h1 class="page-header d-flex justify-content-between">
        Sale Report By Category 
        <!-- <button type="button" class="btn btn-outline-theme me-2 add-item">Add Item</button> -->
        <!-- Items <small>page header description goes here...</small> -->
    </h1>


    <!-- BEGIN #datatable -->
    <div id="datatable" class="mb-5">
        <!-- <h4>Categories</h4> -->
        <div class="card">
            <div class="card-body">
                <form id="report" action="<?=URL?>/report/sale_report_by_category" method="POST" class="report">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="title" class="form-label">Start Date</label> <span class="color-red">*</span>
                            <input type="date" class="form-control validate-input start_date" id="start_date" name="start_date" value="<?= $start_date ?>" required="">
                        </div>

                        <div class="col-md-4">
                            <label for="title" class="form-label">End Date</label> <span class="color-red">*</span>
                            <input type="date" class="form-control validate-input end_date" id="end_date" name="end_date" value="<?= $end_date ?>" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-md-9 col-md-3 text-end">
                            <button type="button" class="btn btn-outline-theme me-2 generate_report">Generate Report</button>
                        </div>
                    </div>
                </form>
                <?php if(isset($report_data)) { 
                        
                    ?>
                    <table id="category" class="table text-nowrap w-100 mt-2">
                        <tbody>
                            <?php if(!empty($report_data)) { ?>
                                <?php foreach ($report_data as $row) { ?>
                                    <tr>
                                        <th colspan="5" class="text-center text-theme">
                                            <?= date('d-m-Y', strtotime($row->invoice_date)) ?>
                                        </th>
                                    </tr>
                                    <?php $detail = $this->Reportmodel->getSalesReportByCategory(date('Y-m-d', strtotime($row->invoice_date))); ?>
                                    <?php if(!empty($detail)) { 
                                        $total_price = $total_discount = $total_net = $total_quantity = 0;
                                    ?>
                                        <tr>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <!-- <th>Invoice Price</th> -->
                                            <th>Discount</th>
                                            <th>Total</th>
                                            <th>Net</th>
                                        </tr>
                                        <?php foreach ($detail as $value) { ?>
                                            <tr>
                                                <td><?= ($value->itemCategory != '') ? $value->itemCategory : 'Open Items' ?></td>
                                                <td>
                                                    <?= $value->quantity ?>
                                                    <?php $total_quantity += $value->quantity ?>
                                                </td>
                                                <td>
                                                    <?= $value->sale_discount ?>
                                                    <?php $total_discount += $value->sale_discount ?>        
                                                </td>
                                                <td>
                                                    <?= $value->sale_discount + $value->net_price ?>
                                                    <?php $total_price += $value->sale_discount + $value->net_price ?>          
                                                </td>
                                                <td>
                                                    <?= $value->net_price ?>
                                                    <?php $total_net += $value->net_price ?>  
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <th class="text-theme">Grand Total </th>
                                            <th class="text-succefss"><?= $total_quantity ?></th>
                                            <th class="text-succesfs">PKR <?= $total_discount ?></th>
                                            <th class="text-succesfs">PKR <?= $total_price ?></th>
                                            <th class="text-successf">PKR <?= $total_net ?></th>
                                        </tr>
                                        <tr><td colspan="5" class="text-center"style="color: #ffffff">d</td></tr>
                                    <?php } ?>
                                <?php }?>
                            <?php } else {?>
                                <tbody>
                                    <tr><td colspan="6" class="text-center">Data Not Found!</td></tr>
                                </tbody>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
            <!-- <div class="hljs-container rounded-bottom">
                <pre><code class="xml" data-url="assets/data/table-plugins/code-1.json"></code></pre>
            </div> -->
        </div>
    </div>
    <!-- END #datatable -->
</div>
<!-- END #content -->