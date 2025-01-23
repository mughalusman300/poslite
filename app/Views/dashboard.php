    
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <h1 class="page-header mb-3">
            Hi, <?= $_SESSION['user_name'] ?>. <small>here's what's happening with your store today.</small>
        </h1>
        
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-6">
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-6 -->
                    <div class="col-sm-6 mb-3 d-flex flex-column">
                        <!-- BEGIN card -->
                        <div class="card mb-3 flex-1">
                            <!-- BEGIN card-body -->
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">Total Items</h5>
                                        <div>Store Total Items</div>
                                    </div>
                                    <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                                </div>
                                
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-1"><?= $items ?></h3>
                                        <div class="text-success fw-600 fs-13px">
                                            <!-- <i class="fa fa-caret-up"></i> +3.59% -->
                                        </div>
                                    </div>
                                    <div class="w-50px h-50px bg-primary bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-shopping-bag"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- END card-body -->
                        </div>
                        <!-- END card -->
                        
                        <!-- BEGIN card -->
                        <div class="card">
                            <!-- BEGIN card-body -->
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">Accounts</h5>
                                        <div>Pending payable and receivable</div>
                                    </div>
                                    <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                                </div>
                                
                                <!-- BEGIN row -->
                                <div class="row">
                                    <!-- BEGIN col-6 -->
                                    <div class="col-6 text-center">
                                        <div class="w-50px h-50px bg-primary bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center mb-2 ms-auto me-auto">
                                            <i class="far fa-lg fa-money-bill-alt text-primary"></i>
                                            <!-- <i class="fa fa-thumbs-up fa-lg text-primary"></i> -->
                                        </div>
                                        <div class="fw-600 text-body"><?= $account['payable'] ?></div>
                                        <div class="fs-13px">Payable</div>
                                    </div>
                                    <!-- END col-6 -->
                                    
                                    <!-- BEGIN col-6 -->
                                    <div class="col-6 text-center">
                                        <div class="w-50px h-50px bg-primary bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center mb-2 ms-auto me-auto">
                                            <i class="far fa-lg fa-money-bill-alt text-primary"></i>
                                        </div>
                                        <div class="fw-600 text-body"><?= $account['receivable'] ?></div>
                                        <div class="fs-13px">Recievable</div>
                                    </div>
                                    <!-- END col-6 -->
                                </div>
                                <!-- END row -->
                            </div>
                            <!-- END card-body -->
                        </div>
                        <!-- END card -->
                    </div>
                    <!-- END col-6 -->
                    
                    <!-- BEGIN col-6 -->
                    <div class="col-sm-6 mb-3">
                        <!-- BEGIN card -->
                        <div class="card h-100">    
                            <!-- BEGIN card-body -->
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">Sales </h5>
                                        <div class="fs-13px">Last 30 Days Sale</div>
                                    </div>
                                    <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                                </div>
                                
                                <div class="mb-4">
                                    <h3 class="mb-1"><?= $sale ?></h3> <!-- this is total sale of current month -->
                                    <?php if (strpos($sale_comaprision, '+') !== false): ?>
                                        <div class="text-success fs-13px fw-600">
                                            <i class="fa fa-caret-up"></i> <?= $sale_comaprision ?> <!-- comaprision with last month -->
                                        </div>
                                    <?php else:?>
                                        <div class="text-danger fs-13px fw-600">
                                            <i class="fa fa-caret-down"></i> <?= $sale_comaprision ?>  <!-- comaprision with last month -->
                                        </div>
                                    <?php endif;?>
                                </div>
                                
                                <div class="progress mb-4" style="height: 10px;">
                                    <!-- <div class="progress-bar bg-primary" style="width: 42.66%"></div>
                                    <div class="progress-bar bg-teal" style="width: 36.80%"></div>
                                    <div class="progress-bar bg-yellow" style="width: 15.34%"></div>
                                    <div class="progress-bar bg-pink" style="width: 9.20%"></div>
                                    <div class="progress-bar bg-gray-200" style="width: 5.00%"></div> -->

                                    <div class="progress-bar bg-primary" style="width: 100.00%"></div>
                                    <div class="progress-bar bg-teal" style="width: 00.00%"></div>
                                    <div class="progress-bar bg-yellow" style="width: 00.00%"></div>
                                    <div class="progress-bar bg-pink" style="width: 00.00%"></div>
                                    <div class="progress-bar bg-gray-200" style="width: 00.00%"></div>
                                </div>
                                
                                <div class="fs-13px">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1 d-flex align-items-center">
                                            <i class="fa fa-circle fs-9px fa-fw text-primary me-2"></i> Store Counter
                                        </div>
                                        <div class="fw-600 text-body">100.00%</div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1 d-flex align-items-center">
                                            <i class="fa fa-circle fs-9px fa-fw text-teal me-2"></i> Online Store
                                        </div>
                                        <div class="fw-600 text-body">0.00%</div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1 d-flex align-items-center">
                                            <i class="fa fa-circle fs-9px fa-fw text-warning me-2"></i> Referral
                                        </div>
                                        <div class="fw-600 text-body">0.00%</div>
                                    </div>
                                    <div class="d-flex align-items-center mb-15px">
                                        <div class="flex-grow-1 d-flex align-items-center">
                                            <i class="fa fa-circle fs-9px fa-fw text-gray-200 me-2"></i> Others
                                        </div>
                                        <div class="fw-600 text-body">0.00%</div>
                                    </div>
                                    <div class="fs-12px text-end d-none">
                                        <span class="fs-10px">powered by </span>
                                        <span class="d-inline-flex fw-600">
                                            <span class="text-primary">G</span>
                                            <span class="text-danger">o</span>
                                            <span class="text-warning">o</span>
                                            <span class="text-primary">g</span>
                                            <span class="text-green">l</span>
                                            <span class="text-danger">e</span>
                                        </span>
                                        <span class="fs-10px">Analytics API</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END card-body -->
                        </div>
                        <!-- END card -->
                    </div>
                    <!-- END col-6 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END col-6 -->
            
            <!-- BEGIN col-6 -->
            <div class="col-xl-6 mb-3">
                <!-- BEGIN card -->
                <div class="card h-100">
                    <!-- BEGIN card-body -->
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="flex-grow-1">
                                <h5 class="mb-1">Sales Analytics</h5>
                                <div class="fs-13px">Weekly sales performance chart</div>
                            </div>
                            <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                        </div>
                        <!-- <div id="chart"></div> -->
                        <div>
                            <button id="previousButton" class="btn btn-outline-theme btn-sm">Previous Week</button>
                            <button id="recentButton" class="btn btn-outline-theme btn-sm">Latest Week</button>
                            <button id="nextButton" class="btn btn-outline-theme btn-sm">Next Week</button>
                        </div>
                        <div id="salesChart"></div>


                    </div>
                    <!-- END card-body -->
                </div>
                <!-- END card -->
            </div>  
            <!-- END col-6 -->
        </div>
        <!-- END row -->
        
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-6 mb-3">
                <!-- BEGIN card -->
                <div class="card h-100">
                    <!-- BEGIN card-body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-grow-1">
                                <h5 class="mb-1">Bestseller Items</h5>
                                <div class="fs-13px">Top 5 product sales of last 30 days</div>
                            </div>
                            <a href="#" class="text-decoration-none d-none">See All</a>
                        </div>
                        
                        <!-- product-1 -->
                            <?php if($best_sell_items) : ?>
                                    <?php 
                                        $counter = 1;
                                        foreach($best_sell_items as $item) : ?>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="d-flex align-items-center justify-content-center me-3 w-50px h-50px bg-white p-3px rounded">
                                                    <img src="assets/img/product/product-1.jpg" alt="" class="ms-100 mh-100">
                                                </div>

                                                <div class="flex-grow-1">
                                                    <div>
                                                        <?php if($counter == 1) :?>
                                                        <div class="text-primary fs-10px fw-600">TOP SALES</div>
                                                        <?php endif; ?>
                                                        <div class="text-body fw-600"><?= $item->itemName ?></div>
                                                        <div class="fs-13px">RS/- <?= $item->salePrice ?></div>
                                                    </div>
                                                </div>
                                                <div class="ps-3 text-center">
                                                    <div class="text-body fw-600"><?= $item->total_quantity_sold ?></div>
                                                    <div class="fs-13px">sales</div>
                                                </div>
                                            </div>
                                    <?php $counter++;
                                        endforeach; ?>
                            <?php endif; ?>
                        
                    </div>
                    <!-- END card-body -->
                </div>
                <!-- END card -->
            </div>
            <!-- END col-6 -->
            
            <!-- BEGIN col-6 -->
            <div class="col-xl-6 mb-3">
                <!-- BEGIN card -->
                <div class="card h-100">
                    <!-- BEGIN card-body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-grow-1">
                                <h5 class="mb-1">Transaction Payment Mode</h5>
                                <div class="fs-13px">Last 30 days transaction history</div>
                            </div>
                            <a href="#" class="text-decoration-none d-none">See All</a>
                        </div>
                        
                        <!-- BEGIN table-responsive -->
                        <div class="table-responsive mb-n2">
                            <table class="table table-borderless mb-0">
                                <thead>
                                    <tr class="text-body">
                                        <th class="ps-0">No</th>
                                        <th>Payment Mode</th>
                                        <th class="text-end pe-0">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($payment_modes_trans) : ?>
                                            <?php 
                                                $counter = 1;
                                                foreach($payment_modes_trans as $mode) : ?>
                                                    <tr>
                                                        <td class="ps-0"><?= $counter ?>.</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="w-40px h-40px rounded">
                                                                    <img src="assets/img/icon/<?= $mode->img?>.png" alt="" class="ms-100 mh-100">
                                                                </div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    <div class="fw-600 text-body"><?= $mode->payment_type?></div>
                                                                    <div class="fs-13px d-none">5 minutes ago</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-end pe-0"> <?= $mode->total_net_price?></td>
                                                    </tr>
                                                <?php $counter++;
                                                    endforeach; ?>
                                            <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- END table-responsive -->
                    </div>
                    <!-- END card-body -->
                </div>
                <!-- END card -->
            </div>
            <!-- END col-6 -->
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->
