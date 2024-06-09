
<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
        <li class="breadcrumb-item active">STARTER PAGE</li>
    </ul>
    
    <h1 class="page-header d-flex justify-content-between">
        Sale Report By Date 
        <!-- <button type="button" class="btn btn-outline-theme me-2 add-item">Add Item</button> -->
        <!-- Items <small>page header description goes here...</small> -->
    </h1>


    <!-- BEGIN #datatable -->
    <div id="datatable" class="mb-5">
        <!-- <h4>Categories</h4> -->
        <div class="card">
            <div class="card-body">
                <form id="report" action="<?=URL?>/report/sale_report_by_date" method="POST" class="report">
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
                        $i= 1;
                        $total_price = $total_discount = $total_net = $total_invoice_total = 0;
                    ?>
                    <table id="category" class="table text-nowrap w-100 mt-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <!-- <th>Invoice Price</th> -->
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Net</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($report_data)) { ?>
                                <?php foreach ($report_data as $row) { ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td>
                                            <a href="<?=URL?>/report/sale_report_by_date_detail/<?= date('Y-m-d', strtotime($row->invoice_date))?>" target="_blank">
                                                <?= date('d-m-Y', strtotime($row->invoice_date)) ?>
                                            </a> 
                                        </td>
                                       <!--  <td>
                                            <?= $row->invoice_net + $row->invoice_discount ?>
                                            <?php $total_price += $row->invoice_net + $row->invoice_discount; ?>
                                        </td> -->
                                        <td>
                                            <?= $row->invoice_discount + 0 ?>
                                            <?php $total_discount += $row->invoice_discount; ?>        
                                        </td>
                                        <td>
                                            <?= $row->invoice_total ?>
                                            <?php $total_invoice_total += $row->invoice_total; ?>          
                                        </td>
                                        <td>
                                            <?= $row->invoice_net ?>
                                            <?php $total_net += $row->invoice_net; ?>          
                                        </td>
                                    </tr>
                                <?php $i++; }?>
                                <tr>
                                    <td ></td>
                                    <td> <b>Grand Total </b></td>
                                    <!-- <td> <b>PKR <?= $total_price ?></b></td> -->
                                    <td> <b>PKR <?= $total_discount ?></b></td>
                                    <td> <b>PKR <?= $total_invoice_total ?></b></td>
                                    <td> <b>PKR <?= $total_net ?></b></td>
                                </tr>
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