    <!-- BEGIN #sidebar -->
    <div id="sidebar" class="app-sidebar">
        <!-- BEGIN scrollbar -->
        <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
            <!-- BEGIN menu -->
            <div class="menu">
                <div class="menu-item active">
                    <a href="<?= URL?>/dashboard" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>

                <div class="menu-header">Inventory</div>
                <div class="menu-item">
                    <a href="<?= URL?>/item" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">Items</span>
                    </a>
                </div>
                <div class="menu-header">Accounts</div>
                <div class="menu-item">
                    <a href="<?= URL?>/item/underconstruction" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">Accounts</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= URL?>/item/underconstruction" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">Expense</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= URL?>/item/underconstruction" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">Bank</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= URL?>/item/underconstruction" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">PNL</span>
                    </a>
                </div>

                <div class="menu-header">System Administration</div>
                <div class="menu-item">
                    <a href="<?= URL?>/users" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">Users</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= URL?>/item" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">User Logs</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= URL?>/item" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">POS Setting</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= URL?>/item" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">System Logs</span>
                    </a>
                </div>

                <div class="menu-header">Reporst</div>
                <div class="menu-item has-sub">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa fa-shopping-bag"></i>
                            <!-- <span class="menu-icon-label">6</span> -->
                        </span>
                        <span class="menu-text">Sale Reports</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="<?= URL?>/report/sale_report_by_date" class="menu-link">
                                <span class="menu-text">Sales Report By Date</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="<?= URL?>/report/sale_report_by_category" class="menu-link">
                                <span class="menu-text">Sale Report By Category</span>
                            </a>
                        </div>
                        <div class="menu-item">
                             <a href="<?= URL?>/report/sale_report_by_payment" class="menu-link">
                             <a href="#" class="menu-link">
                                <span class="menu-text">Sale Report By Payment</span> 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <a href="<?= URL?>/item" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">Expense Report</span>
                    </a>
                </div>                
            </div>
            <!-- END menu -->
        </div>
        <!-- END scrollbar -->
        
        <!-- BEGIN mobile-sidebar-backdrop -->
        <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
        <!-- END mobile-sidebar-backdrop -->
    </div>
    <!-- END #sidebar -->