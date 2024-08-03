
<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
        <li class="breadcrumb-item active">STARTER PAGE</li>
    </ul>
    
    <h1 class="page-header d-flex justify-content-between">
        Sales
        <!-- <button type="button" class="btn btn-outline-theme me-2 add-item">Add Item</button> -->
        <!-- Items <small>page header description goes here...</small> -->
    </h1>


    <!-- BEGIN #datatable -->
    <div id="datatable" class="mb-5">
        <!-- <h4>Categories</h4> -->
        <div class="card">
            <div class="card-body">
                <form id="sales" action="<?=URL?>/sales" method="POST" class="sales">
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
                    <div class="row mb-4">
                        <div class="offset-md-9 col-md-3 text-end">
                            <button type="button" class="btn btn-outline-theme me-2 generate_sales">Generate Sale</button>
                        </div>
                    </div>
                </form>
                
                <table id="sales_table" class="table text-nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice #</th>
                            <th>Date</th>
                            <!-- <th>Invoice Price</th> -->
                            <th>Discount</th>
                            <th>Total</th>
                            <th>Net</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($sale_data)) { ?>
                            <?php foreach ($sale_data as $row) { ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td>
                                        <?= $row->invoice_code ?>
                                        <!-- <a href="<?=URL?>/report/sale_report_by_date_detail/<?= date('Y-m-d', strtotime($row->invoice_date))?>" target="_blank">
                                            <?= date('d-m-Y', strtotime($row->invoice_date)) ?>
                                        </a>  -->        
                                    </td>
                                    <td><?= date('Y-m-d', strtotime($row->invoice_date))?></td>
                                    <td>
                                        <?= $row->invoice_discount + 0 ?>
                                    </td>
                                    <td>
                                        <?= $row->invoice_total ?>
                                    </td>
                                    <td>
                                        <?= $row->invoice_net ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-theme print">Print</button>
                                        <button class="btn btn-outline-theme return-full-invoice">Return Full Invoice</button>
                                        <button class="btn btn-outline-theme return-item" data-invoice_code="<?= $row->invoice_code ?>">Return Item</button>
                                    </td>
                                </tr>
                            <?php $i++; }?>
                        <?php } else {?>
                            <tr><td colspan="6" class="text-center">Data Not Found!</td></tr>
                        <?php } ?>
                    </tbody>
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
<?php include(APPPATH . 'Views/modals/return-item-modal.php') ?>