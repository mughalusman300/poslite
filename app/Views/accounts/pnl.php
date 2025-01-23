
<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
        <li class="breadcrumb-item active">STARTER PAGE</li>
    </ul>
    
    <h1 class="page-header d-flex justify-content-between">
        Profit & Loss Report
        <!-- <button type="button" class="btn btn-outline-theme me-2 add-item">Add Item</button> -->
        <!-- Items <small>page header description goes here...</small> -->
    </h1>


    <!-- BEGIN #datatable -->
    <div id="datatable" class="mb-5">
        <!-- <h4>Categories</h4> -->
        <div class="row">
            <div class="card col-md-12">
                <div class="card-body">
                    <form id="report" action="<?=URL?>/accounts/pnl" method="POST" class="report">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="title" class="form-label">Start Date</label> <span class="color-red">*</span>
                                <input type="text" readonly="" class="form-control validate-input start_date" placeholder="dd-mm-yyyy" id="start_date" value="<?= $start_date ?>" name="start_date" >
                                <!-- <input type="date" class="form-control validate-input start_date" id="start_date" name="start_date" value="<?= $start_date ?>" required=""> -->
                            </div>

                            <div class="col-md-4">
                                <label for="title" class="form-label">End Date</label> <span class="color-red">*</span>
                                <input type="text" readonly="" class="form-control validate-input end_date" placeholder="dd-mm-yyyy" id="end_date" value="<?= $end_date ?>" name="end_date" >
                                <!-- <input type="date" class="form-control validate-input end_date" id="end_date" name="end_date" value="<?= $end_date ?>" required=""> -->
                            </div>
                            <div class="col-md-2" style="display: grid;">
                                <label for="title" style="visibility: hidden;" class="form-label">Generate </label>

                                <button type="button" class="btn btn-outline-theme me-2 generate_report">Generate Report</button>
                            </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="offset-md-9 col-md-3 text-end">
                                <button type="button" class="btn btn-outline-theme me-2 generate_report">Generate Report</button>
                            </div>
                        </div> -->
                    </form>
                    <?php if(isset($expense_data) && empty($expense_data)) { ?>
                        <table id="category" class="table text-nowrap w-100 mt-2">
                            <thead>
                            </thead>
                            <tbody>
                                <?php if(empty($expense_data)) { ?>
                                    <tbody>
                                        <tr><td colspan="6" class="text-center">Data Not Found!</td></tr>
                                    </tbody>
                                <?php }?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
                <!-- <div class="hljs-container rounded-bottom">
                    <pre><code class="xml" data-url="assets/data/table-plugins/code-1.json"></code></pre>
                </div> -->
            </div>
        </div>

        <?php if(!empty($expense_data)) { ?>
            <div class="row mt-3">
                <div class="card col-md-6">
                    <div class="card-body">
                        <table id="expense" class="table table-bordered text-nowrap w-100 mt-2">
                            <thead>
                                <tr>
                                    <th style="text-align: left">Expense</th>
                                    <th style="text-align: right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($expense_data)) { ?>
                                    <?php 
                                        $total_expense = 0;
                                        foreach ($expense_data as $row) { ?>
                                        <tr>
                                            <td style="text-align: left"><?= $row->narration ?></td>
                                            <td style="text-align: right"><?= $row->amount ?></td>
                                        </tr>
                                    <?php 
                                        $total_expense = $total_expense + $row->amount;
                                    } ?>
                                    <tr>
                                        <td style="text-align: left; font-size:20px;">Total Expense</td>
                                        <td style="text-align: right"><span style="font-size:20px;"><mark><?= number_format($total_expense, 2) ?></mark></span></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card col-md-6">
                    <div class="card-body">
                        <table id="expense" class="table table-bordered text-nowrap w-100 mt-2">
                            <tbody>
                                <?php if(!empty($items_data)) { ?>
                                    <tr>
                                        <td style="text-align: left">Total Item Purchase Price</td>
                                        <td style="text-align: right"><?= number_format($items_data->purch_price, 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">Total Item Sale Price</td>
                                        <td style="text-align: right"><?= number_format($items_data->sale_price, 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">Total Discount</td>
                                        <td style="text-align: right"><?= number_format($items_data->discount, 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">Item Net Price</td>
                                        <td style="text-align: right"><?= number_format($items_data->net_price, 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">Total Revenue</td>
                                        <?php $total_revenue = $items_data->net_price - $items_data->purch_price; ?>
                                        <td style="text-align: right"><?= number_format($total_revenue, 2) ?></td>
                                    </tr>
                                <?php  } ?>
                                <?php if(!empty($expense_data)) { ?>
                                    <tr>
                                        <td style="text-align: left">Total Expense</td>
                                        <td style="text-align: right"><?= number_format($total_expense, 2) ?></td>
                                    </tr>
                                <?php  } ?>
                                <?php if(isset($total_revenue)) { ?>
                                    <tr style="font-size: 20px">
                                        <td style="text-align: left">Profit & Loss</td>
                                        <?php $pnl = $total_revenue - $total_expense; ?>
                                        <td style="text-align: right"><mark><?= number_format($pnl, 2) ?></mark></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- END #datatable -->
</div>
<!-- END #content -->